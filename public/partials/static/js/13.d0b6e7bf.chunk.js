webpackJsonp([13],{1891:function(e,t,n){"use strict";function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function o(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}function a(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var i=n(0),c=n.n(i),l=n(1892),u=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),p=function(e){function t(){return r(this,t),o(this,(t.__proto__||Object.getPrototypeOf(t)).apply(this,arguments))}return a(t,e),u(t,[{key:"render",value:function(){return c.a.createElement("div",null,c.a.createElement(l.a,{title:"Organiza",key:"organiza",grupo:this.props.colaboradores.organiza}),c.a.createElement(l.a,{title:"Patrocina",key:"patrocina",grupo:this.props.colaboradores.patrocina}),c.a.createElement(l.a,{title:"Apoya",key:"apoya",grupo:this.props.colaboradores.apoya}),c.a.createElement(l.a,{title:"Auspicia",key:"auspicia",grupo:this.props.colaboradores.auspicia}),c.a.createElement(l.a,{title:"Colaboran",key:"colaboran",grupo:this.props.colaboradores.colaboran}),c.a.createElement(l.a,{title:"Medios Asociados",key:"medios",grupo:this.props.colaboradores.medios}),c.a.createElement(l.a,{title:"Participa",key:"participa",grupo:this.props.colaboradores.participa}))}}]),t}(i.Component);t.default=p},1892:function(e,t,n){"use strict";function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function o(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}function a(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}function i(e,t){return Object.freeze(Object.defineProperties(e,{raw:{value:Object.freeze(t)}}))}var c=n(0),l=n.n(c),u=n(23),p=n(364),s=n.n(p),f=n(26),b=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),y=i(["\n\theight: auto;\n"],["\n\theight: auto;\n"]),h=i(["\n\tmargin: 0 0 12px 0;\n"],["\n\tmargin: 0 0 12px 0;\n"]),m=i(["\n\t&&&& {\n\t\tmargin-bottom: 24px;\n\t}\n"],["\n\t&&&& {\n\t\tmargin-bottom: 24px;\n\t}\n"]),g=Object(f.a)(s.a)(y),d=f.a.h4(h),O=Object(f.a)(u.i.Column)(m),E=function(e){function t(){return r(this,t),o(this,(t.__proto__||Object.getPrototypeOf(t)).apply(this,arguments))}return a(t,e),b(t,[{key:"render",value:function(){return l.a.createElement(u.d,null,l.a.createElement(u.i,{columns:4,doubling:!0,centered:!0},l.a.createElement(u.i.Row,{textAlign:"center"},l.a.createElement("h2",null,this.props.title)),l.a.createElement(u.i.Row,{textAlign:"center"},this.props.grupo.map(function(e){return l.a.createElement(O,{textAlign:"center",key:e.nombre},l.a.createElement(g,{src:e.logo[0],width:e.logo[1],height:e.logo[2],alt:e.nombre}),l.a.createElement(d,null,e.nombre))}))))}}]),t}(c.Component);t.a=E}});
//# sourceMappingURL=13.d0b6e7bf.chunk.js.map