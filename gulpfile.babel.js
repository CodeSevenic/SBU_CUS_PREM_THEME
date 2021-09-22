import yargs from 'yargs';
import gulp from 'gulp';
const sass = require('gulp-sass')(require('sass'));
import cleanCSS from 'gulp-clean-css';
import gulpIf from 'gulp-if';
import sourceMaps from 'gulp-sourcemaps';

const PRODUCTION = yargs.argv.prod;

export const styles = () => {
  return gulp
    .src(['src/assets/scss/bundle.scss', 'src/assets/scss/admin.scss'])
    .pipe(gulpIf(!PRODUCTION, sourceMaps.init()))
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(gulpIf(PRODUCTION, cleanCSS({ compatibility: 'ie8' })))
    .pipe(gulpIf(!PRODUCTION, sourceMaps.write()))
    .pipe(gulp.dest('dist/assets/css'));
};
