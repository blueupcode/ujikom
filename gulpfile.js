const { task, src, dest, parallel } = require("gulp");
const sass = require("gulp-sass")(require("node-sass"));
const cleanCSS = require("gulp-clean-css");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");
const colors = require("colors");

const files = {
    scss: {
        input: ["resources/scss/app.scss"],
        output: "app.css",
        dest: "public/css"
    },
    js: {
        input: [
            "resources/js/util.js",
            "resources/js/modal.js",
            "resources/js/aside.js"
        ],
        output: "app.js",
        dest: "public/js"
    }
}

const uglifyOptions = {
    compress: true,
    mangle: true,
    toplevel: true,
    keep_fnames: false,
};

const cleanCSSOptions = {
    level: {
        1: {
            all: true,
        },
    },
};

const sassOptions = {
    outputStyle: "nested",
};

task("build:style", () => {
    return src(files.scss.input, { base: "./" })
        .pipe(
            sass.sync(sassOptions).on("error", (err) => {
                console.log(`Error at ${colors.cyan(err.relativePath)} on line ${err.line}`);
                console.log(colors.red(err.messageOriginal));
            })
        )
        .pipe(cleanCSS(cleanCSSOptions))
        .pipe(concat(files.scss.output))
        .pipe(dest(files.scss.dest));
});

task("build:script", () => {
    return src(files.js.input, { base: "./" })
        .pipe(concat(files.js.output))
        .pipe(uglify(uglifyOptions))
        .on("error", (err) => {
            console.log(`Error: ${colors.red(err.cause.message)}`);
        })
        .pipe(dest(files.js.dest));
});

task("build", parallel("build:style", "build:script"));
