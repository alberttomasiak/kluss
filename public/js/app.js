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

eval("var apiGeolocationSuccess = function(position) {\r\n\t//alert(\"API geolocation success!\\n\\nlat = \" + position.coords.latitude + \"\\nlng = \" + position.coords.longitude);\r\n    $('#kluss--lat').val(position.coords.latitude);\r\n    $('#kluss--lng').val(position.coords.longitude);\r\n};\r\n\r\nvar tryAPIGeolocation = function() {\r\n\tjQuery.post( \"https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDIUAq_cUlo5wamjqeI_nBEA4VUVREKLis\", function(success) {\r\n\t\tapiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});\r\n  })\r\n  .fail(function(err) {\r\n    //alert(\"API Geolocation error! \\n\\n\"+err);\r\n  });\r\n};\r\n\r\nvar browserGeolocationSuccess = function(position) {\r\n\t//alert(\"Browser geolocation success!\\n\\nlat = \" + position.coords.latitude + \"\\nlng = \" + position.coords.longitude);\r\n    $('#kluss--lat').val(position.coords.latitude);\r\n    $('#kluss--lng').val(position.coords.longitude);\r\n};\r\n\r\nvar browserGeolocationFail = function(error) {\r\n  switch (error.code) {\r\n    case error.TIMEOUT:\r\n      //alert(\"Browser geolocation error !\\n\\nTimeout.\");\r\n      break;\r\n    case error.PERMISSION_DENIED:\r\n      if(error.message.indexOf(\"Only secure origins are allowed\") == 0) {\r\n        tryAPIGeolocation();\r\n      }\r\n      break;\r\n    case error.POSITION_UNAVAILABLE:\r\n      //alert(\"Browser geolocation error !\\n\\nPosition unavailable.\");\r\n      break;\r\n  }\r\n};\r\n\r\nvar tryGeolocation = function() {\r\n  if (navigator.geolocation) {\r\n    navigator.geolocation.getCurrentPosition(\r\n    \tbrowserGeolocationSuccess,\r\n      browserGeolocationFail,\r\n      {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});\r\n  }\r\n};\r\n\r\ntryGeolocation();\r\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2FwcC5qcz84YjY3Il0sInNvdXJjZXNDb250ZW50IjpbInZhciBhcGlHZW9sb2NhdGlvblN1Y2Nlc3MgPSBmdW5jdGlvbihwb3NpdGlvbikge1xyXG5cdC8vYWxlcnQoXCJBUEkgZ2VvbG9jYXRpb24gc3VjY2VzcyFcXG5cXG5sYXQgPSBcIiArIHBvc2l0aW9uLmNvb3Jkcy5sYXRpdHVkZSArIFwiXFxubG5nID0gXCIgKyBwb3NpdGlvbi5jb29yZHMubG9uZ2l0dWRlKTtcclxuICAgICQoJyNrbHVzcy0tbGF0JykudmFsKHBvc2l0aW9uLmNvb3Jkcy5sYXRpdHVkZSk7XHJcbiAgICAkKCcja2x1c3MtLWxuZycpLnZhbChwb3NpdGlvbi5jb29yZHMubG9uZ2l0dWRlKTtcclxufTtcclxuXHJcbnZhciB0cnlBUElHZW9sb2NhdGlvbiA9IGZ1bmN0aW9uKCkge1xyXG5cdGpRdWVyeS5wb3N0KCBcImh0dHBzOi8vd3d3Lmdvb2dsZWFwaXMuY29tL2dlb2xvY2F0aW9uL3YxL2dlb2xvY2F0ZT9rZXk9QUl6YVN5RElVQXFfY1VsbzV3YW1qcWVJX25CRUE0VlVWUkVLTGlzXCIsIGZ1bmN0aW9uKHN1Y2Nlc3MpIHtcclxuXHRcdGFwaUdlb2xvY2F0aW9uU3VjY2Vzcyh7Y29vcmRzOiB7bGF0aXR1ZGU6IHN1Y2Nlc3MubG9jYXRpb24ubGF0LCBsb25naXR1ZGU6IHN1Y2Nlc3MubG9jYXRpb24ubG5nfX0pO1xyXG4gIH0pXHJcbiAgLmZhaWwoZnVuY3Rpb24oZXJyKSB7XHJcbiAgICAvL2FsZXJ0KFwiQVBJIEdlb2xvY2F0aW9uIGVycm9yISBcXG5cXG5cIitlcnIpO1xyXG4gIH0pO1xyXG59O1xyXG5cclxudmFyIGJyb3dzZXJHZW9sb2NhdGlvblN1Y2Nlc3MgPSBmdW5jdGlvbihwb3NpdGlvbikge1xyXG5cdC8vYWxlcnQoXCJCcm93c2VyIGdlb2xvY2F0aW9uIHN1Y2Nlc3MhXFxuXFxubGF0ID0gXCIgKyBwb3NpdGlvbi5jb29yZHMubGF0aXR1ZGUgKyBcIlxcbmxuZyA9IFwiICsgcG9zaXRpb24uY29vcmRzLmxvbmdpdHVkZSk7XHJcbiAgICAkKCcja2x1c3MtLWxhdCcpLnZhbChwb3NpdGlvbi5jb29yZHMubGF0aXR1ZGUpO1xyXG4gICAgJCgnI2tsdXNzLS1sbmcnKS52YWwocG9zaXRpb24uY29vcmRzLmxvbmdpdHVkZSk7XHJcbn07XHJcblxyXG52YXIgYnJvd3Nlckdlb2xvY2F0aW9uRmFpbCA9IGZ1bmN0aW9uKGVycm9yKSB7XHJcbiAgc3dpdGNoIChlcnJvci5jb2RlKSB7XHJcbiAgICBjYXNlIGVycm9yLlRJTUVPVVQ6XHJcbiAgICAgIC8vYWxlcnQoXCJCcm93c2VyIGdlb2xvY2F0aW9uIGVycm9yICFcXG5cXG5UaW1lb3V0LlwiKTtcclxuICAgICAgYnJlYWs7XHJcbiAgICBjYXNlIGVycm9yLlBFUk1JU1NJT05fREVOSUVEOlxyXG4gICAgICBpZihlcnJvci5tZXNzYWdlLmluZGV4T2YoXCJPbmx5IHNlY3VyZSBvcmlnaW5zIGFyZSBhbGxvd2VkXCIpID09IDApIHtcclxuICAgICAgICB0cnlBUElHZW9sb2NhdGlvbigpO1xyXG4gICAgICB9XHJcbiAgICAgIGJyZWFrO1xyXG4gICAgY2FzZSBlcnJvci5QT1NJVElPTl9VTkFWQUlMQUJMRTpcclxuICAgICAgLy9hbGVydChcIkJyb3dzZXIgZ2VvbG9jYXRpb24gZXJyb3IgIVxcblxcblBvc2l0aW9uIHVuYXZhaWxhYmxlLlwiKTtcclxuICAgICAgYnJlYWs7XHJcbiAgfVxyXG59O1xyXG5cclxudmFyIHRyeUdlb2xvY2F0aW9uID0gZnVuY3Rpb24oKSB7XHJcbiAgaWYgKG5hdmlnYXRvci5nZW9sb2NhdGlvbikge1xyXG4gICAgbmF2aWdhdG9yLmdlb2xvY2F0aW9uLmdldEN1cnJlbnRQb3NpdGlvbihcclxuICAgIFx0YnJvd3Nlckdlb2xvY2F0aW9uU3VjY2VzcyxcclxuICAgICAgYnJvd3Nlckdlb2xvY2F0aW9uRmFpbCxcclxuICAgICAge21heGltdW1BZ2U6IDUwMDAwLCB0aW1lb3V0OiAyMDAwMCwgZW5hYmxlSGlnaEFjY3VyYWN5OiB0cnVlfSk7XHJcbiAgfVxyXG59O1xyXG5cclxudHJ5R2VvbG9jYXRpb24oKTtcclxuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvYXBwLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);