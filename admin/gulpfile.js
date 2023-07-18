'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function buildStyles() {
    return gulp.src('./style/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./css'));
};

exports.buildStyles = buildStyles;
exports.watch = function () {
    gulp.watch('./style/**/*.scss', gulp.series('buildStyles'));
};