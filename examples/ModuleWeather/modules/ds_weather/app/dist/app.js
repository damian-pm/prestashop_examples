jsonpFunction([1],{"+Iod":function(e,t,i){e.exports=i.p+"img/thunderstorm.7e644c1a.svg"},"+fdr":function(e,t,i){var a=i("LulZ");"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var r=i("rjj0").default;r("dd01122a",a,!0,{shadowMode:!1,sourceMap:!1})},"+rny":function(e,t,i){var a=i("Bn/R");"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var r=i("rjj0").default;r("1d755bd0",a,!0,{shadowMode:!1,sourceMap:!1})},0:function(e,t,i){e.exports=i("NHnr")},"1eoU":function(e,t,i){e.exports=i.p+"img/night.242ca2f3.jpg"},"7wvZ":function(e,t,i){var a=i("kxFB");t=e.exports=i("FZ+f")(!1),t.push([e.i,"main[data-v-5842378c]{width:100%;height:100%;background-position:50%;background-size:cover;background-repeat:no-repeat;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-ms-flex-pack:distribute;justify-content:space-around;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-shadow:0 19px 38px rgba(0,0,0,.3),0 15px 12px rgba(0,0,0,.22);box-shadow:0 19px 38px rgba(0,0,0,.3),0 15px 12px rgba(0,0,0,.22)}.app--day[data-v-5842378c]{background-image:-webkit-gradient(linear,left top,left bottom,from(rgba(0,0,0,.1)),to(rgba(0,0,0,.1))),url("+a(i("K6p1"))+");background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1)),url("+a(i("K6p1"))+")}.app--night[data-v-5842378c]{background-image:-webkit-gradient(linear,left top,left bottom,from(rgba(0,0,0,.1)),to(rgba(0,0,0,.1))),url("+a(i("1eoU"))+");background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1)),url("+a(i("1eoU"))+")}@media screen and (min-width:450px){main[data-v-5842378c]{width:330px;height:600px;border-radius:5px}}",""])},"Bn/R":function(e,t,i){t=e.exports=i("FZ+f")(!1),t.push([e.i,"section[data-v-a8acd09e]{width:100%;padding-top:25px;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:space-evenly;-ms-flex-pack:space-evenly;justify-content:space-evenly}.cloudiness img[data-v-a8acd09e],.humidity img[data-v-a8acd09e],.wind-speed img[data-v-a8acd09e]{width:48px;height:48px;vertical-align:middle}",""])},"C/RA":function(e,t,i){e.exports=i.p+"img/rain.a56a7915.svg"},Iz0Z:function(e,t,i){e.exports=i.p+"img/humidity.e7cc8477.svg"},K6p1:function(e,t,i){e.exports=i.p+"img/morning.a81f0a40.jpg"},LAU0:function(e,t,i){var a=i("7wvZ");"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var r=i("rjj0").default;r("ea5e617a",a,!0,{shadowMode:!1,sourceMap:!1})},LulZ:function(e,t,i){t=e.exports=i("FZ+f")(!1),t.push([e.i,"section[data-v-148cacf0]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.location[data-v-148cacf0]{text-transform:uppercase;font-weight:700}.weather__description[data-v-148cacf0]{text-transform:lowercase;margin-left:10%;margin-right:10%;text-align:center}.weather__description[data-v-148cacf0]:first-letter{text-transform:uppercase}.weather__icon[data-v-148cacf0]{width:12em;padding-bottom:9em}",""])},NHnr:function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=i("/5sW"),r={name:"Weather",props:{location:{type:String,required:!0},description:{type:String,required:!0},icon:{type:String,required:!0}}},n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("section",[i("div",{staticClass:"location"},[e._v(e._s(e.location))]),e._v(" "),i("div",{staticClass:"weather__description"},[e._v(e._s(e.description))]),e._v(" "),i("img",{staticClass:"weather__icon",attrs:{src:e.icon,alt:e.description}})])},o=[],s=i("XyMi");function c(e){i("+fdr")}var l=!1,u=c,p="data-v-148cacf0",d=null,f=Object(s["a"])(r,n,o,l,u,p,d),h=f.exports,m={name:"Temperature",props:{value:{type:Number,required:!0},high:{type:Number,required:!0},low:{type:Number,required:!0}},data:function(){return{scale:"Celcius"}},computed:{scaleSymbol:function(){return this.scale.charAt(0)},fValue:function(){return this.toFahrenheit(this.value)},fHigh:function(){return this.toFahrenheit(this.high)},fLow:function(){return this.toFahrenheit(this.low)}},methods:{toFahrenheit:function(e){return Math.floor(1.8*e+32)},toggleTemperature:function(){"Celcius"===this.scale?this.scale="Fahrenheit":this.scale="Celcius"}}},v=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("section",[a("div",{staticClass:"temperature__value"},[e._v(e._s("C"===e.scaleSymbol?e.value:e.fValue))]),e._v(" "),a("div",{staticClass:"temperature__right"},[a("div",{staticClass:"temperature__scale"},[a("a",{attrs:{href:"#"},on:{click:function(t){t.preventDefault(),e.toggleTemperature(t)}}},[e._v("°"+e._s(e.scaleSymbol))])]),e._v(" "),a("div",{staticClass:"temperature__high"},[a("img",{attrs:{src:i("aF19"),alt:"high temperature"}}),a("span",[e._v(e._s("C"===e.scaleSymbol?e.high:e.fHigh))]),e._v("°\n        ")]),e._v(" "),a("div",{staticClass:"temperature__low"},[a("img",{attrs:{src:i("ickf"),alt:"low temperature"}}),a("span",[e._v(e._s("C"===e.scaleSymbol?e.low:e.fLow))]),e._v("°\n        ")])])])},g=[];function b(e){i("Z63u")}var x=!1,w=b,_="data-v-35c83f4c",y=null,k=Object(s["a"])(m,v,g,x,w,_,y),j=k.exports,C={name:"Measurements",props:{cloudiness:{type:Number,required:!0},windSpeed:{type:Number,required:!0},humidity:{type:Number,required:!0}}},M=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("section",[a("div",{staticClass:"cloudiness"},[a("img",{attrs:{src:i("jG2R"),alt:"cloudiness"}}),a("span",{staticClass:"cloudiness__value"},[e._v(e._s(e.cloudiness))]),e._v("%\n    ")]),e._v(" "),a("div",{staticClass:"wind-speed"},[a("img",{attrs:{src:i("cUAQ"),alt:"wind speed"}}),a("span",{staticClass:"wind__value"},[e._v(e._s(e.windSpeed))]),e._v("m/s\n    ")]),e._v(" "),a("div",{staticClass:"humidity"},[a("img",{attrs:{src:i("Iz0Z"),alt:"humidity"}}),a("span",{staticClass:"humidity__value"},[e._v(e._s(e.humidity))]),e._v("%\n    ")])])},F=[];function S(e){i("+rny")}var A=!1,z=S,Z="data-v-a8acd09e",L=null,N=Object(s["a"])(C,M,F,A,z,Z,L),T=N.exports,R=(i("EuXz"),i("SldL"),i("7hDC")),q=i.n(R),E=i("Z60a"),O=i.n(E),I=i("C9uT"),W=i.n(I),H=function(){function e(){O()(this,e),this.cloudiness=0,this.windSpeed=0,this.humidity=0,this.temperatureValue=0,this.temperatureHigh=0,this.temperatureLow=0,this.location=" ",this.description="Please connect to internet to fetch latest forecast :)",this.weatherIcon=i("Tavs"),this.update()}return W()(e,[{key:"update",value:function(){var e=this;navigator.onLine&&navigator.geolocation.getCurrentPosition(function(t){return e.updateForecast(t)})}},{key:"updateForecast",value:function(){var e=q()(regeneratorRuntime.mark(function e(t){var i;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return i=null,e.prev=1,e.next=4,this.getForecast(t.coords);case 4:i=e.sent,e.next=10;break;case 7:e.prev=7,e.t0=e["catch"](1),i=this.getErrorData();case 10:this.populate(i);case 11:case"end":return e.stop()}},e,this,[[1,7]])}));return function(t){return e.apply(this,arguments)}}()},{key:"getForecast",value:function(){var e=q()(regeneratorRuntime.mark(function e(t){var i,a,r;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return i="397c1bb9bb232f18d2942f0af3c948de",a="https://api.openweathermap.org/data/2.5/weather?lat=".concat(t.latitude,"&lon=").concat(t.longitude,"&appid=").concat(i,"&units=metric"),e.next=4,fetch(a);case 4:return r=e.sent,e.next=7,r.json();case 7:return e.abrupt("return",e.sent);case 8:case"end":return e.stop()}},e,this)}));return function(t){return e.apply(this,arguments)}}()},{key:"getErrorData",value:function(){return{clouds:{all:0},wind:{speed:0},main:{humidity:0,temp:0,temp_max:0,temp_min:0},weather:[{id:0,description:"There's a problem at the weather forecast server ¯\\_(ツ)_/¯"}],name:null,sys:{country:null}}}},{key:"populate",value:function(e){this.cloudiness=e.clouds.all,this.windSpeed=e.wind.speed,this.humidity=e.main.humidity,this.temperatureValue=Math.round(e.main.temp),this.temperatureHigh=Math.round(e.main.temp_max),this.temperatureLow=Math.round(e.main.temp_min),this.location=this.formatLocation(e.name,e.sys.country),this.description=e.weather[0].description,this.weatherIcon=this.getWeatherIcon(e.weather[0].id)}},{key:"formatLocation",value:function(e,t){return null===e&&null===t?"":"".concat(e,", ").concat(t)}},{key:"getWeatherIcon",value:function(e){return this.isThunderstorm(e)?i("+Iod"):this.isDrizzle(e)||this.isRain(e)?i("C/RA"):this.isSnow(e)?i("ptMa"):i("Tavs")}},{key:"isThunderstorm",value:function(e){return e>199&&e<233}},{key:"isDrizzle",value:function(e){return e>299&&e<322}},{key:"isRain",value:function(e){return e>499&&e<532}},{key:"isSnow",value:function(e){return e>599&&e<623}}]),e}(),U=H,$={name:"WeatherApp",components:{Weather:h,Temperature:j,Measurements:T},data:function(){return{forecast:new U}}},D=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("main",[i("Measurements",{attrs:{cloudiness:this.forecast.cloudiness,windSpeed:this.forecast.windSpeed,humidity:this.forecast.humidity}}),e._v(" "),i("Temperature",{attrs:{value:this.forecast.temperatureValue,high:this.forecast.temperatureHigh,low:this.forecast.temperatureLow}}),e._v(" "),i("Weather",{attrs:{location:this.forecast.location,description:this.forecast.description,icon:this.forecast.weatherIcon}})],1)},B=[];function G(e){i("LAU0")}var V=!1,P=G,K="data-v-5842378c",Y=null,Q=Object(s["a"])($,D,B,V,P,K,Y),X=Q.exports,J={name:"AppCredits",props:{year:{type:Number,required:!0}}},ee=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("footer",[i("small",[e._v("© "),e._m(0),e._v(" "+e._s(e.year)+" - A "),i("cite",[e._v("freeCodeCamp")]),e._v(" Project")])])},te=[function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("b",[i("a",{attrs:{href:"https://twitter.com/jimmerioles",target:"_blank",rel:"noopener"}},[e._v("Jim Merioles")])])}];function ie(e){i("mlo+")}var ae=!1,re=ie,ne="data-v-635903fa",oe=null,se=Object(s["a"])(J,ee,te,ae,re,ne,oe),ce=se.exports,le={name:"App",components:{WeatherApp:X,AppCredits:ce},data:function(){return{date:new Date}},computed:{year:function(){return this.date.getFullYear()},period:function(){var e=this.date.getHours();return e>5&&e<18?"app--day":"app--night"}}},ue=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{attrs:{id:"app"}},[i("div",{staticClass:"app",class:e.period},[i("WeatherApp",{class:e.period}),e._v(" "),i("AppCredits",{class:e.period,attrs:{year:e.year}})],1)])},pe=[];function de(e){i("iLkv")}var fe=!1,he=de,me=null,ve=null,ge=Object(s["a"])(le,ue,pe,fe,he,me,ve),be=ge.exports,xe=i("ydGU");Object(xe["a"])("".concat("/modules/ds_weather/app/dist/","service-worker.js"),{ready:function(){console.log("App is being served from cache by a service worker.\nFor more details, visit https://goo.gl/AFskqB")},cached:function(){console.log("Content has been cached for offline use.")},updated:function(){console.log("New content is available; please refresh.")},offline:function(){console.log("No internet connection found. App is running in offline mode.")},error:function(e){console.error("Error during service worker registration:",e)}}),a["a"].config.productionTip=!1,new a["a"]({render:function(e){return e(be)}}).$mount("#app")},Tavs:function(e,t,i){e.exports=i.p+"img/cloud.775ad4d1.svg"},Z63u:function(e,t,i){var a=i("zfGN");"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var r=i("rjj0").default;r("2747bd6c",a,!0,{shadowMode:!1,sourceMap:!1})},aF19:function(e,t,i){e.exports=i.p+"img/high.d70bbaa2.svg"},bBjZ:function(e,t,i){t=e.exports=i("FZ+f")(!1),t.push([e.i,"@import url(https://fonts.googleapis.com/css?family=Open+Sans);",""]),t.push([e.i,"*{-webkit-box-sizing:border-box;box-sizing:border-box;margin:0;padding:0}body{font-family:Open Sans,sans-serif;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;color:hsla(0,0%,100%,.9)}a{text-decoration:none;color:inherit;-webkit-transition:color .2s ease-in;transition:color .2s ease-in}.app{height:100vh;width:100vw;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.app--day{background-color:#6cb9c8}.app--night{background-color:#484f60}.app--day a:hover{color:rgba(46,146,167,.9)}.app--night a:hover{color:rgba(0,0,0,.5)}",""])},cUAQ:function(e,t,i){e.exports=i.p+"img/wind.05f5c4cf.svg"},iLkv:function(e,t,i){var a=i("bBjZ");"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var r=i("rjj0").default;r("5e470ec8",a,!0,{shadowMode:!1,sourceMap:!1})},ickf:function(e,t,i){e.exports=i.p+"img/low.61a481cf.svg"},jG2R:function(e,t,i){e.exports=i.p+"img/cloud.2b02f907.svg"},kMpY:function(e,t,i){t=e.exports=i("FZ+f")(!1),t.push([e.i,"footer[data-v-635903fa]{text-align:center;position:absolute;bottom:10px;visibility:hidden}@media screen and (min-width:450px){footer[data-v-635903fa]{visibility:visible}}",""])},"mlo+":function(e,t,i){var a=i("kMpY");"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var r=i("rjj0").default;r("210090ec",a,!0,{shadowMode:!1,sourceMap:!1})},ptMa:function(e,t,i){e.exports=i.p+"img/snow.0bb8cb16.svg"},zfGN:function(e,t,i){t=e.exports=i("FZ+f")(!1),t.push([e.i,"section[data-v-35c83f4c]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}.temperature__value[data-v-35c83f4c]{font-size:7em;color:hsla(0,0%,100%,.75)}.temperature__right[data-v-35c83f4c]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}.temperature__scale[data-v-35c83f4c]{padding-top:5px;font-size:2em;font-weight:700;color:hsla(0,0%,100%,.75)}.temperature__high[data-v-35c83f4c]{padding-top:5px}.temperature__high img[data-v-35c83f4c],.temperature__low img[data-v-35c83f4c]{vertical-align:middle}",""])}},[0]);
//# sourceMappingURL=app.js.map