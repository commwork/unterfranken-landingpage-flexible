const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();

// Local URL
const PROXY_URL = 'localhost:8888/unterfranken-landingpage';

const paths = {
  scss: {
    src: 'assets/scss/style.scss',
    adminSrc: 'assets/scss/admin.scss',
    watch: 'assets/scss/**/*.scss',
  },
  css: 'style.css',
};

function styles() {
  return gulp
    .src(paths.scss.src)
    .pipe(sourcemaps.init())
    .pipe(
      sass({ outputStyle: 'expanded' }).on('error', function (err) {
        sass.logError.call(this, err);
        this.emit('end');
      })
    )
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('.'))
    .pipe(browserSync.stream());
}

function adminStyles() {
  return gulp
    .src(paths.scss.adminSrc)
    .pipe(sourcemaps.init())
    .pipe(
      sass({ outputStyle: 'expanded' }).on('error', function (err) {
        sass.logError.call(this, err);
        this.emit('end');
      })
    )
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('.'))
    .pipe(browserSync.stream());
}

function serve(done) {
  browserSync.init({
    proxy: PROXY_URL,
    open: true,
    notify: false,
    ghostMode: false, // no scroll/click/form sync across devices
  });
  done();
}

function reload(done) {
  browserSync.reload();
  done();
}

function watch() {
  gulp.watch(paths.scss.watch, gulp.parallel(styles, adminStyles));
  gulp.watch(['*.php', '**/*.php', 'assets/js/**/*.js'], reload);
}

const build = gulp.parallel(styles, adminStyles);
const dev = gulp.series(build, gulp.parallel(serve, watch));

exports.styles = styles;
exports.adminStyles = adminStyles;
exports.serve = serve;
exports.watch = watch;
exports.build = build;
exports.default = dev;
