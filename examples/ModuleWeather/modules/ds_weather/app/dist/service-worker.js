/**
 * Welcome to your Workbox-powered service worker!
 *
 * You'll need to register this file in your web app and you should
 * disable HTTP caching for this file too.
 * See https://goo.gl/nhQhGp
 *
 * The rest of the code is auto-generated. Please don't update this file
 * directly; instead, make changes to your Workbox build configuration
 * and re-run your build process.
 * See https://goo.gl/YYPcyY
 */

importScripts(
  "/modules/ds_weather/app/dist/precache-manifest.250d552c58ca015bcc2d30c50d6516e3.js",
  "https://storage.googleapis.com/workbox-cdn/releases/3.0.0-beta.0/workbox-sw.js"
);

workbox.core.setCacheNameDetails({prefix: "PWeatherApp"});

/**
 * The workboxSW.precacheAndRoute() method efficiently caches and responds to
 * requests for URLs in the manifest.
 * See https://goo.gl/S9QRab
 */
self.__precacheManifest = [].concat(self.__precacheManifest || []);
workbox.precaching.suppressWarnings();
workbox.precaching.precacheAndRoute(self.__precacheManifest, {});
