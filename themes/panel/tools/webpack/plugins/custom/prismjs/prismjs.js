// Prism - is a lightweight, extensible syntax highlighter, built with modern web standards in mind: https://prismjs.com/

window.Prism = require("prismjs/prism.components");
require("prismjs/components/prism-markup.components");
require("prismjs/components/prism-markup-templating.components");
require("prismjs/components/prism-bash.components");
require("prismjs/components/prism-javascript.components");
require("prismjs/components/prism-scss.components");
require("prismjs/components/prism-css.components");
require("prismjs/components/prism-php.components");
require("prismjs/components/prism-php-extras.components");
require("prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.components");
require("@/src/components/vendors/plugins/prism.init.components");

require('./prismjs.scss');
