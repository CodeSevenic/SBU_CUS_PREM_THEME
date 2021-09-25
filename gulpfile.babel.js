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
    src: 'src/assets/js/bundle.js',
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
};

export const clean = () => del(['dist']);

export const styles = () => {
  return gulp
    .src(paths.styles.src)
    .pipe(gulpIf(!PRODUCTION, sourceMaps.init()))
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(gulpIf(PRODUCTION, cleanCSS({ compatibility: 'ie8' })))
    .pipe(gulpIf(!PRODUCTION, sourceMaps.write()))
    .pipe(gulp.dest(paths.styles.dest));
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
    .pipe(named)
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
        devtool: !PRODUCTION ? 'inline-source-map' : false,
        mode: PRODUCTION ? 'production' : 'development', //add this
      })
    )
    .pipe(gulp.dest(paths.scripts.dest));
};

export const watch = () => {
  gulp.watch('src/assets/scss/**/*.scss', styles);
  gulp.watch(paths.images.src, images);
  gulp.watch(paths.other.src, copy);
};

export const copy = () => {
  return gulp.src(paths.other.src).pipe(gulp.dest(paths.other.dest));
};

export const dev = gulp.series(
  clean,
  gulp.parallel(styles, images, scripts, copy),
  watch
);
export const build = gulp.series(
  clean,
  gulp.parallel(styles, images, scripts, copy)
);

export default dev;
