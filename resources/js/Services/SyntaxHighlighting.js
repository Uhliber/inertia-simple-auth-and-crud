import hljs from "highlight.js";
import javascript from "highlight.js/lib/languages/javascript";
import php from "highlight.js/lib/languages/php";

import "highlight.js/styles/github-dark.css";

hljs.registerLanguage("php", php);
hljs.registerLanguage("javascript", javascript);

export function highlight(selector) {
  if (!selector) {
    hljs.highlightAll();
    return;
  }

  document.querySelectorAll(selector + " pre code").forEach(highlightElement);
}

export function highlightElement(element) {
  hljs.highlightElement(element);
}
