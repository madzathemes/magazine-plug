var gulp = require('gulp'),
    zip = require('gulp-zip'),
    jshint = require('gulp-watch'),
    replace = require('gulp-replace'),
    injectVersion = require('gulp-inject-version'),
    ignore = require('gulp-ignore');



gulp.task('version', function () {

    return gulp.src('gulp/magazin-plug.php')
        .pipe(injectVersion({
            package_file: 'version.json',
            prepend: '',
        }))
        .pipe(gulp.dest('./'));

});

gulp.task('plugins', function () {

        var theme = "rimi";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "ouch";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "anews";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))

        var theme = "xnews";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "newspaper2017";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "nextnews";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "techpro";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "boomnews";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "fullstory";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "infowazz";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "Mellany";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "NewsPaperWars";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "xnews";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))
        var theme = "zeronews";    gulp.src('../../themes/'+theme+'/inc/functions/gulp/functions-plugins.php').pipe(injectVersion({ package_file: 'version.json', prepend: '', })).pipe(gulp.dest('../../themes/'+theme+'/inc/functions/'))

});

gulp.task('zip', function () {

    return gulp.src(['./**', '!package.json', '!version.json', '!gulpfile.js', '!.git/', '!.git/**', '!.gitignore', '!.DS_Store', '!node_modules/', '!gulp/**', '!gulp/', '!node_modules/**'], { base:'../'})
        .pipe(zip('magazine-plug.zip'))
        .pipe(gulp.dest('../../themes/boomnews/all_plugins/'))
        .pipe(gulp.dest('../../themes/fullstory/all_plugins/'))
        .pipe(gulp.dest('../../themes/infowazz/all_plugins/'))
        .pipe(gulp.dest('../../themes/Mellany/all_plugins/'))
        .pipe(gulp.dest('../../themes/newspaper2017/all_plugins/'))
        .pipe(gulp.dest('../../themes/NewsPaperWars/all_plugins/'))
        .pipe(gulp.dest('../../themes/techpro/all_plugins/'))
        .pipe(gulp.dest('../../themes/nextnews/all_plugins/'))
        .pipe(gulp.dest('../../themes/xnews/all_plugins/'))
        .pipe(gulp.dest('../../themes/zeronews/all_plugins/'))
        .pipe(gulp.dest('../../themes/ouch/all_plugins/'))
        .pipe(gulp.dest('../../themes/anews/all_plugins/'))
        .pipe(gulp.dest('../../themes/rimi/all_plugins/'));
});

gulp.task('watch', function(){

  gulp.watch('version.json', ['version', 'zip', 'plugins']);

});

gulp.task('default', ['version', 'zip', 'plugins', 'watch']);
