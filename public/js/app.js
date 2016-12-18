/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("var apiGeolocationSuccess = function(position) {\r\n\talert(\"API geolocation success!\\n\\nlat = \" + position.coords.latitude + \"\\nlng = \" + position.coords.longitude);\r\n};\r\n\r\nvar tryAPIGeolocation = function() {\r\n\tjQuery.post( \"https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDCa1LUe1vOczX1hO_iGYgyo8p_jYuGOPU\", function(success) {\r\n\t\tapiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});\r\n  })\r\n  .fail(function(err) {\r\n    alert(\"API Geolocation error! \\n\\n\"+err);\r\n  });\r\n};\r\n\r\nvar browserGeolocationSuccess = function(position) {\r\n\talert(\"Browser geolocation success!\\n\\nlat = \" + position.coords.latitude + \"\\nlng = \" + position.coords.longitude);\r\n};\r\n\r\nvar browserGeolocationFail = function(error) {\r\n  switch (error.code) {\r\n    case error.TIMEOUT:\r\n      alert(\"Browser geolocation error !\\n\\nTimeout.\");\r\n      break;\r\n    case error.PERMISSION_DENIED:\r\n      if(error.message.indexOf(\"Only secure origins are allowed\") == 0) {\r\n        tryAPIGeolocation();\r\n      }\r\n      break;\r\n    case error.POSITION_UNAVAILABLE:\r\n      alert(\"Browser geolocation error !\\n\\nPosition unavailable.\");\r\n      break;\r\n  }\r\n};\r\n\r\nvar tryGeolocation = function() {\r\n  if (navigator.geolocation) {\r\n    navigator.geolocation.getCurrentPosition(\r\n    \tbrowserGeolocationSuccess,\r\n      browserGeolocationFail,\r\n      {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});\r\n  }\r\n};\r\n\r\ntryGeolocation();//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2FwcC5qcz84YjY3Il0sInNvdXJjZXNDb250ZW50IjpbInZhciBhcGlHZW9sb2NhdGlvblN1Y2Nlc3MgPSBmdW5jdGlvbihwb3NpdGlvbikge1xyXG5cdGFsZXJ0KFwiQVBJIGdlb2xvY2F0aW9uIHN1Y2Nlc3MhXFxuXFxubGF0ID0gXCIgKyBwb3NpdGlvbi5jb29yZHMubGF0aXR1ZGUgKyBcIlxcbmxuZyA9IFwiICsgcG9zaXRpb24uY29vcmRzLmxvbmdpdHVkZSk7XHJcbn07XHJcblxyXG52YXIgdHJ5QVBJR2VvbG9jYXRpb24gPSBmdW5jdGlvbigpIHtcclxuXHRqUXVlcnkucG9zdCggXCJodHRwczovL3d3dy5nb29nbGVhcGlzLmNvbS9nZW9sb2NhdGlvbi92MS9nZW9sb2NhdGU/a2V5PUFJemFTeURDYTFMVWUxdk9jelgxaE9faUdZZ3lvOHBfall1R09QVVwiLCBmdW5jdGlvbihzdWNjZXNzKSB7XHJcblx0XHRhcGlHZW9sb2NhdGlvblN1Y2Nlc3Moe2Nvb3Jkczoge2xhdGl0dWRlOiBzdWNjZXNzLmxvY2F0aW9uLmxhdCwgbG9uZ2l0dWRlOiBzdWNjZXNzLmxvY2F0aW9uLmxuZ319KTtcclxuICB9KVxyXG4gIC5mYWlsKGZ1bmN0aW9uKGVycikge1xyXG4gICAgYWxlcnQoXCJBUEkgR2VvbG9jYXRpb24gZXJyb3IhIFxcblxcblwiK2Vycik7XHJcbiAgfSk7XHJcbn07XHJcblxyXG52YXIgYnJvd3Nlckdlb2xvY2F0aW9uU3VjY2VzcyA9IGZ1bmN0aW9uKHBvc2l0aW9uKSB7XHJcblx0YWxlcnQoXCJCcm93c2VyIGdlb2xvY2F0aW9uIHN1Y2Nlc3MhXFxuXFxubGF0ID0gXCIgKyBwb3NpdGlvbi5jb29yZHMubGF0aXR1ZGUgKyBcIlxcbmxuZyA9IFwiICsgcG9zaXRpb24uY29vcmRzLmxvbmdpdHVkZSk7XHJcbn07XHJcblxyXG52YXIgYnJvd3Nlckdlb2xvY2F0aW9uRmFpbCA9IGZ1bmN0aW9uKGVycm9yKSB7XHJcbiAgc3dpdGNoIChlcnJvci5jb2RlKSB7XHJcbiAgICBjYXNlIGVycm9yLlRJTUVPVVQ6XHJcbiAgICAgIGFsZXJ0KFwiQnJvd3NlciBnZW9sb2NhdGlvbiBlcnJvciAhXFxuXFxuVGltZW91dC5cIik7XHJcbiAgICAgIGJyZWFrO1xyXG4gICAgY2FzZSBlcnJvci5QRVJNSVNTSU9OX0RFTklFRDpcclxuICAgICAgaWYoZXJyb3IubWVzc2FnZS5pbmRleE9mKFwiT25seSBzZWN1cmUgb3JpZ2lucyBhcmUgYWxsb3dlZFwiKSA9PSAwKSB7XHJcbiAgICAgICAgdHJ5QVBJR2VvbG9jYXRpb24oKTtcclxuICAgICAgfVxyXG4gICAgICBicmVhaztcclxuICAgIGNhc2UgZXJyb3IuUE9TSVRJT05fVU5BVkFJTEFCTEU6XHJcbiAgICAgIGFsZXJ0KFwiQnJvd3NlciBnZW9sb2NhdGlvbiBlcnJvciAhXFxuXFxuUG9zaXRpb24gdW5hdmFpbGFibGUuXCIpO1xyXG4gICAgICBicmVhaztcclxuICB9XHJcbn07XHJcblxyXG52YXIgdHJ5R2VvbG9jYXRpb24gPSBmdW5jdGlvbigpIHtcclxuICBpZiAobmF2aWdhdG9yLmdlb2xvY2F0aW9uKSB7XHJcbiAgICBuYXZpZ2F0b3IuZ2VvbG9jYXRpb24uZ2V0Q3VycmVudFBvc2l0aW9uKFxyXG4gICAgXHRicm93c2VyR2VvbG9jYXRpb25TdWNjZXNzLFxyXG4gICAgICBicm93c2VyR2VvbG9jYXRpb25GYWlsLFxyXG4gICAgICB7bWF4aW11bUFnZTogNTAwMDAsIHRpbWVvdXQ6IDIwMDAwLCBlbmFibGVIaWdoQWNjdXJhY3k6IHRydWV9KTtcclxuICB9XHJcbn07XHJcblxyXG50cnlHZW9sb2NhdGlvbigpO1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL2FwcC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);