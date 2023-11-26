/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*******************!*\
  !*** ./script.ts ***!
  \*******************/


var styles = ['styles/bataty.css', 'styles/fryteczki.css', 'styles/baklazan.css'];
var element = document.getElementById('links');
var styleId = document.getElementById('pageStyle');
function initFunction() {
  var _loop = function _loop() {
    var new_link = document.createElement("a");
    new_link.textContent = ">style ".concat(i + 1, "<");
    new_link.href = styles[i];
    new_link.addEventListener("click", function (event) {
      event.preventDefault();
      styleId.setAttribute("href", new_link.href);
      // console.log("Style: ",new_link.href);
    });

    element.appendChild(new_link);
    element.appendChild(document.createElement("br"));
  };
  for (var i = 0; i < styles.length; i++) {
    _loop();
  }
}
initFunction();
/******/ })()
;