var env = require("./environment.json");
var gulp = require("gulp");

// Structure: copies files to the home directory for CMS functionality
gulp.task("structure", function () {
	if (env.cms == "wordpress")
		gulp.src("wp_base/*.*").pipe(gulp.dest("."));
	if (env.cms == "processwire")
		gulp.src("pw_base/*.*").pipe(gulp.dest("."));
})