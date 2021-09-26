import { createRequire } from 'module';
const require = createRequire(import.meta.url);

import gulp from 'gulp';
import cleanCSS from 'gulp-clean-css';
import gulpIf from 'gulp-if';
import sourceMaps from 'gulp-sourcemaps';
import imagemin from 'gulp-imagemin';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import del from 'del';
import webpack from 'webpack-stream';
import named from 'vinyl-named';
import browserSync from 'browser-sync';
import zip from 'gulp-zip';
import replace from 'gulp-replace';
const info = require('./package.json');

const server = browserSync.create();

const sass = gulpSass(dartSass);

//  Change this to true if building for PRODUCTION
let PRODUCTION = false;

const paths = {
  styles: {
    src: ['src/assets/scss/bundle.scss', 'src/assets/scss/admin.scss'],
    dest: 'dist/assets/css',
  },
  images: {
    src: 'src/assets/images/**/*.{jpg,jpeg,png,svg,gif}',
    dest: 'dist/assets/images',
  },
  scripts: {
    src: 'src/assets/js/*.js',
    dest: 'dist/assets/js',
  },
  other: {
    src: [
      'src/assets/**/*',
      '!src/assets/{images,js,scss}',
      '!src/assets/{images,js,scss}/**/*',
    ],
    dest: 'dist/assets',
  },
  package: {
    src: [
      '**/*',
      '!.vscode',
      '!node_modules{,/**}',
      '!src{,/**}',
      '!.babelrc',
      '!packaged',
      '!.gitignore',
      '!gulpfile.babel.js',
      '!package.json',
      '!package-lock.json',
    ],
    dest: 'packaged',
  },
};

export const serve = (done) => {
  server.init({
    proxy: 'http://premiumtheme.local',
  });
  done();
};

export const reload = (done) => {
  server.reload();
  done();
};

export const clean = () => del(['dist']);

export const styles = () => {
  return gulp
    .src(paths.styles.src)
    .pipe(gulpIf(!PRODUCTION, sourceMaps.init()))
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(gulpIf(PRODUCTION, cleanCSS({ compatibility: 'ie8' })))
    .pipe(gulpIf(!PRODUCTION, sourceMaps.write()))
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(server.stream());
};

export const images = () => {
  return gulp
    .src(paths.images.src)
    .pipe(gulpIf(!PRODUCTION, imagemin()))
    .pipe(gulp.dest(paths.images.dest));
};

export const scripts = () => {
  return gulp
    .src(paths.scripts.src)
    .pipe(named())
    .pipe(
      webpack({
        module: {
          rules: [
            {
              test: /\.js$/,
              use: {
                loader: 'babel-loader',
                options: {
                  presets: ['@babel/preset-env'],
                },
              },
            },
          ],
        },
        output: {
          filename: '[name].js',
        },
        externals: {
          jquery: 'jQuery',
        },
        devtool: !PRODUCTION ? 'inline-source-map' : false,
        mode: PRODUCTION ? 'production' : 'development', //add this
      })
    )
    .pipe(gulp.dest(paths.scripts.dest));
};

export const compress = () => {
  return gulp
    .src(paths.package.src)
    .pipe(replace('_themename', info.name))
    .pipe(zip(`${info.name}.zip`))
    .pipe(gulp.dest(paths.package.dest));
};

export const watch = () => {
  gulp.watch('src/assets/scss/**/*.scss', styles);
  gulp.watch('src/assets/js/**/*.js', gulp.series(scripts, reload));
  gulp.watch('**/*.php', reload);
  gulp.watch(paths.images.src, gulp.series(images, reload));
  gulp.watch(paths.other.src, gulp.series(copy, reload));
};

export const copy = () => {
  return gulp.src(paths.other.src).pipe(gulp.dest(paths.other.dest));
};

export const dev = gulp.series(
  clean,
  gulp.parallel(styles, images, scripts, copy),
  serve,
  watch
);

// Remember to set PRODUCTION to true
export const build = gulp.series(
  clean,
  gulp.parallel(styles, images, scripts, copy)
);
// Remember to set PRODUCTION to true
export const bundle = gulp.series(build, compress);

export default dev;
