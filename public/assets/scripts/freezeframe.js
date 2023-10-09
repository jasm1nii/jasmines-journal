!(function (t, e) {
  "object" == typeof exports && "object" == typeof module
    ? (module.exports = e())
    : "function" == typeof define && define.amd
    ? define([], e)
    : "object" == typeof exports
    ? (exports.Freezeframe = e())
    : (t.Freezeframe = e());
})(window, function () {
  return (function (t) {
    var e = {};
    function n(i) {
      if (e[i]) return e[i].exports;
      var r = (e[i] = { i: i, l: !1, exports: {} });
      return t[i].call(r.exports, r, r.exports, n), (r.l = !0), r.exports;
    }
    return (
      (n.m = t),
      (n.c = e),
      (n.d = function (t, e, i) {
        n.o(t, e) || Object.defineProperty(t, e, { enumerable: !0, get: i });
      }),
      (n.r = function (t) {
        "undefined" != typeof Symbol &&
          Symbol.toStringTag &&
          Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }),
          Object.defineProperty(t, "__esModule", { value: !0 });
      }),
      (n.t = function (t, e) {
        if ((1 & e && (t = n(t)), 8 & e)) return t;
        if (4 & e && "object" == typeof t && t && t.__esModule) return t;
        var i = Object.create(null);
        if (
          (n.r(i),
          Object.defineProperty(i, "default", { enumerable: !0, value: t }),
          2 & e && "string" != typeof t)
        )
          for (var r in t)
            n.d(
              i,
              r,
              function (e) {
                return t[e];
              }.bind(null, r)
            );
        return i;
      }),
      (n.n = function (t) {
        var e =
          t && t.__esModule
            ? function () {
                return t.default;
              }
            : function () {
                return t;
              };
        return n.d(e, "a", e), e;
      }),
      (n.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e);
      }),
      (n.p = "examples"),
      n((n.s = 4))
    );
  })([
    function (t, e, n) {
      var i, r;
      !(function (o, s) {
        "use strict";
        (i = [n(2)]),
          void 0 ===
            (r = function (t) {
              return (function (t, e) {
                var n = t.jQuery,
                  i = t.console;
                function r(t, e) {
                  for (var n in e) t[n] = e[n];
                  return t;
                }
                var o = Array.prototype.slice;
                function s(t, e, a) {
                  if (!(this instanceof s)) return new s(t, e, a);
                  var c,
                    l = t;
                  ("string" == typeof t && (l = document.querySelectorAll(t)),
                  l)
                    ? ((this.elements =
                        ((c = l),
                        Array.isArray(c)
                          ? c
                          : "object" == typeof c && "number" == typeof c.length
                          ? o.call(c)
                          : [c])),
                      (this.options = r({}, this.options)),
                      "function" == typeof e ? (a = e) : r(this.options, e),
                      a && this.on("always", a),
                      this.getImages(),
                      n && (this.jqDeferred = new n.Deferred()),
                      setTimeout(this.check.bind(this)))
                    : i.error("Bad element for imagesLoaded " + (l || t));
                }
                (s.prototype = Object.create(e.prototype)),
                  (s.prototype.options = {}),
                  (s.prototype.getImages = function () {
                    (this.images = []),
                      this.elements.forEach(this.addElementImages, this);
                  }),
                  (s.prototype.addElementImages = function (t) {
                    "IMG" == t.nodeName && this.addImage(t),
                      !0 === this.options.background &&
                        this.addElementBackgroundImages(t);
                    var e = t.nodeType;
                    if (e && a[e]) {
                      for (
                        var n = t.querySelectorAll("img"), i = 0;
                        i < n.length;
                        i++
                      ) {
                        var r = n[i];
                        this.addImage(r);
                      }
                      if ("string" == typeof this.options.background) {
                        var o = t.querySelectorAll(this.options.background);
                        for (i = 0; i < o.length; i++) {
                          var s = o[i];
                          this.addElementBackgroundImages(s);
                        }
                      }
                    }
                  });
                var a = { 1: !0, 9: !0, 11: !0 };
                function c(t) {
                  this.img = t;
                }
                function l(t, e) {
                  (this.url = t), (this.element = e), (this.img = new Image());
                }
                return (
                  (s.prototype.addElementBackgroundImages = function (t) {
                    var e = getComputedStyle(t);
                    if (e)
                      for (
                        var n = /url\((['"])?(.*?)\1\)/gi,
                          i = n.exec(e.backgroundImage);
                        null !== i;

                      ) {
                        var r = i && i[2];
                        r && this.addBackground(r, t),
                          (i = n.exec(e.backgroundImage));
                      }
                  }),
                  (s.prototype.addImage = function (t) {
                    var e = new c(t);
                    this.images.push(e);
                  }),
                  (s.prototype.addBackground = function (t, e) {
                    var n = new l(t, e);
                    this.images.push(n);
                  }),
                  (s.prototype.check = function () {
                    var t = this;
                    function e(e, n, i) {
                      setTimeout(function () {
                        t.progress(e, n, i);
                      });
                    }
                    (this.progressedCount = 0),
                      (this.hasAnyBroken = !1),
                      this.images.length
                        ? this.images.forEach(function (t) {
                            t.once("progress", e), t.check();
                          })
                        : this.complete();
                  }),
                  (s.prototype.progress = function (t, e, n) {
                    this.progressedCount++,
                      (this.hasAnyBroken = this.hasAnyBroken || !t.isLoaded),
                      this.emitEvent("progress", [this, t, e]),
                      this.jqDeferred &&
                        this.jqDeferred.notify &&
                        this.jqDeferred.notify(this, t),
                      this.progressedCount == this.images.length &&
                        this.complete(),
                      this.options.debug && i && i.log("progress: " + n, t, e);
                  }),
                  (s.prototype.complete = function () {
                    var t = this.hasAnyBroken ? "fail" : "done";
                    if (
                      ((this.isComplete = !0),
                      this.emitEvent(t, [this]),
                      this.emitEvent("always", [this]),
                      this.jqDeferred)
                    ) {
                      var e = this.hasAnyBroken ? "reject" : "resolve";
                      this.jqDeferred[e](this);
                    }
                  }),
                  (c.prototype = Object.create(e.prototype)),
                  (c.prototype.check = function () {
                    this.getIsImageComplete()
                      ? this.confirm(
                          0 !== this.img.naturalWidth,
                          "naturalWidth"
                        )
                      : ((this.proxyImage = new Image()),
                        this.proxyImage.addEventListener("load", this),
                        this.proxyImage.addEventListener("error", this),
                        this.img.addEventListener("load", this),
                        this.img.addEventListener("error", this),
                        (this.proxyImage.src = this.img.src));
                  }),
                  (c.prototype.getIsImageComplete = function () {
                    return this.img.complete && this.img.naturalWidth;
                  }),
                  (c.prototype.confirm = function (t, e) {
                    (this.isLoaded = t),
                      this.emitEvent("progress", [this, this.img, e]);
                  }),
                  (c.prototype.handleEvent = function (t) {
                    var e = "on" + t.type;
                    this[e] && this[e](t);
                  }),
                  (c.prototype.onload = function () {
                    this.confirm(!0, "onload"), this.unbindEvents();
                  }),
                  (c.prototype.onerror = function () {
                    this.confirm(!1, "onerror"), this.unbindEvents();
                  }),
                  (c.prototype.unbindEvents = function () {
                    this.proxyImage.removeEventListener("load", this),
                      this.proxyImage.removeEventListener("error", this),
                      this.img.removeEventListener("load", this),
                      this.img.removeEventListener("error", this);
                  }),
                  (l.prototype = Object.create(c.prototype)),
                  (l.prototype.check = function () {
                    this.img.addEventListener("load", this),
                      this.img.addEventListener("error", this),
                      (this.img.src = this.url),
                      this.getIsImageComplete() &&
                        (this.confirm(
                          0 !== this.img.naturalWidth,
                          "naturalWidth"
                        ),
                        this.unbindEvents());
                  }),
                  (l.prototype.unbindEvents = function () {
                    this.img.removeEventListener("load", this),
                      this.img.removeEventListener("error", this);
                  }),
                  (l.prototype.confirm = function (t, e) {
                    (this.isLoaded = t),
                      this.emitEvent("progress", [this, this.element, e]);
                  }),
                  (s.makeJQueryPlugin = function (e) {
                    (e = e || t.jQuery) &&
                      ((n = e).fn.imagesLoaded = function (t, e) {
                        return new s(this, t, e).jqDeferred.promise(n(this));
                      });
                  }),
                  s.makeJQueryPlugin(),
                  s
                );
              })(o, t);
            }.apply(e, i)) || (t.exports = r);
      })("undefined" != typeof window ? window : this);
    },
    function (t, e, n) {
      (t.exports = n(3)(!1)).push([
        t.i,
        `.ff-container { 
          display:inline-block;
          position:relative
        }
        .ff-container .ff-image{
          z-index:0;
          vertical-align:top;
          opacity:0
        }
        .ff-container .ff-canvas {
          display:inline-block;
          position:absolute;
          top:0;
          left:0;
          pointer-events:none;
          z-index:1;
          vertical-align:top;
          opacity:0
        }
        .ff-container .ff-canvas.ff-canvas-ready {
          transition:opacity 300ms;
          opacity:1
        }
        .ff-container.ff-active .ff-image {
          opacity:1
        }
        .ff-container.ff-active .ff-canvas.ff-canvas-ready{
          transition:none;
          opacity:0
        }
        .ff-container.ff-active .ff-overlay {
          display:none
        }
        .ff-container.ff-inactive .ff-canvas.ff-canvas-ready{
          transition:opacity 300ms;
          opacity:1
        }
        .ff-container.ff-inactive .ff-image{
          transition:opacity 300ms;
          transition-delay:170ms;
          opacity:0
        }`
      ]);
    },
    function (t, e, n) {
      var i, r;
      "undefined" != typeof window && window,
        void 0 ===
          (r =
            "function" ==
            typeof (i = function () {
              "use strict";
              function t() {}
              var e = t.prototype;
              return (
                (e.on = function (t, e) {
                  if (t && e) {
                    var n = (this._events = this._events || {}),
                      i = (n[t] = n[t] || []);
                    return -1 == i.indexOf(e) && i.push(e), this;
                  }
                }),
                (e.once = function (t, e) {
                  if (t && e) {
                    this.on(t, e);
                    var n = (this._onceEvents = this._onceEvents || {});
                    return ((n[t] = n[t] || {})[e] = !0), this;
                  }
                }),
                (e.off = function (t, e) {
                  var n = this._events && this._events[t];
                  if (n && n.length) {
                    var i = n.indexOf(e);
                    return -1 != i && n.splice(i, 1), this;
                  }
                }),
                (e.emitEvent = function (t, e) {
                  var n = this._events && this._events[t];
                  if (n && n.length) {
                    (n = n.slice(0)), (e = e || []);
                    for (
                      var i = this._onceEvents && this._onceEvents[t], r = 0;
                      r < n.length;
                      r++
                    ) {
                      var o = n[r];
                      i && i[o] && (this.off(t, o), delete i[o]),
                        o.apply(this, e);
                    }
                    return this;
                  }
                }),
                (e.allOff = function () {
                  delete this._events, delete this._onceEvents;
                }),
                t
              );
            })
              ? i.call(e, n, e, t)
              : i) || (t.exports = r);
    },
    function (t, e, n) {
      "use strict";
      t.exports = function (t) {
        var e = [];
        return (
          (e.toString = function () {
            return this.map(function (e) {
              var n = (function (t, e) {
                var n = t[1] || "",
                  i = t[3];
                if (!i) return n;
                if (e && "function" == typeof btoa) {
                  var r =
                      ((s = i),
                      "/*# sourceMappingURL=data:application/json;charset=utf-8;base64," +
                        btoa(unescape(encodeURIComponent(JSON.stringify(s)))) +
                        " */"),
                    o = i.sources.map(function (t) {
                      return "/*# sourceURL=" + i.sourceRoot + t + " */";
                    });
                  return [n].concat(o).concat([r]).join("\n");
                }
                var s;
                return [n].join("\n");
              })(e, t);
              return e[2] ? "@media " + e[2] + "{" + n + "}" : n;
            }).join("");
          }),
          (e.i = function (t, n) {
            "string" == typeof t && (t = [[null, t, ""]]);
            for (var i = {}, r = 0; r < this.length; r++) {
              var o = this[r][0];
              null != o && (i[o] = !0);
            }
            for (r = 0; r < t.length; r++) {
              var s = t[r];
              (null != s[0] && i[s[0]]) ||
                (n && !s[2]
                  ? (s[2] = n)
                  : n && (s[2] = "(" + s[2] + ") and (" + n + ")"),
                e.push(s));
            }
          }),
          e
        );
      };
    },
    function (t, e, n) {
      "use strict";
      n.r(e);
      var i,
        r = n(0),
        o = n.n(r);
      !(function (t) {
        (t.START = "start"), (t.STOP = "stop"), (t.TOGGLE = "toggle");
      })(i || (i = {}));
      const s = (t) => `✨Freezeframe: ${t}✨`,
        a = (t, ...e) => {
          console.error(s(t), ...e);
        },
        c = (t) => ("string" == typeof t ? document.querySelectorAll(t) : t),
        l = (t, e, n) => {
          const i = t instanceof Element ? [t] : t;
          return Array.from(i).reduce((t, e) => {
            if (e instanceof HTMLImageElement)
              t.push(e),
                "gif" !==
                  ((t) => t.split(".").pop().toLowerCase().substring(0, 3))(
                    e.src
                  ) &&
                  n.warnings &&
                  ((t, ...e) => {
                    console.warn(s(t), ...e);
                  })("Image does not appear to be a gif", e);
            else {
              const n = e.querySelectorAll("img");
              n.length
                ? (t = t.concat(Array.from(n)))
                : a("Invalid element", e);
            }
            return t;
          }, []);
        },
        u = (t) => [...new Set(t)],
        m = (t) => {
          const e = window.document.createElement("div");
          e.innerHTML = t;
          const n = e.childNodes;
          return n.length > 1 ? n : n[0];
        };
      var h,
        f,
        d = (function () {
          function t(t, e) {
            for (var n = 0; n < e.length; n++) {
              var i = e[n];
              (i.enumerable = i.enumerable || !1),
                (i.configurable = !0),
                "value" in i && (i.writable = !0),
                Object.defineProperty(t, i.key, i);
            }
          }
          return function (e, n, i) {
            return n && t(e.prototype, n), i && t(e, i), e;
          };
        })(),
        p =
          ((h = ["", ""]),
          (f = ["", ""]),
          Object.freeze(
            Object.defineProperties(h, { raw: { value: Object.freeze(f) } })
          ));
      function g(t, e) {
        if (!(t instanceof e))
          throw new TypeError("Cannot call a class as a function");
      }
      var I = (function () {
          function t() {
            for (
              var e = this, n = arguments.length, i = Array(n), r = 0;
              r < n;
              r++
            )
              i[r] = arguments[r];
            return (
              g(this, t),
              (this.tag = function (t) {
                for (
                  var n = arguments.length, i = Array(n > 1 ? n - 1 : 0), r = 1;
                  r < n;
                  r++
                )
                  i[r - 1] = arguments[r];
                return "function" == typeof t
                  ? e.interimTag.bind(e, t)
                  : "string" == typeof t
                  ? e.transformEndResult(t)
                  : ((t = t.map(e.transformString.bind(e))),
                    e.transformEndResult(
                      t.reduce(e.processSubstitutions.bind(e, i))
                    ));
              }),
              i.length > 0 && Array.isArray(i[0]) && (i = i[0]),
              (this.transformers = i.map(function (t) {
                return "function" == typeof t ? t() : t;
              })),
              this.tag
            );
          }
          return (
            d(t, [
              {
                key: "interimTag",
                value: function (t, e) {
                  for (
                    var n = arguments.length,
                      i = Array(n > 2 ? n - 2 : 0),
                      r = 2;
                    r < n;
                    r++
                  )
                    i[r - 2] = arguments[r];
                  return this.tag(p, t.apply(void 0, [e].concat(i)));
                },
              },
              {
                key: "processSubstitutions",
                value: function (t, e, n) {
                  var i = this.transformSubstitution(t.shift(), e);
                  return "".concat(e, i, n);
                },
              },
              {
                key: "transformString",
                value: function (t) {
                  return this.transformers.reduce(function (t, e) {
                    return e.onString ? e.onString(t) : t;
                  }, t);
                },
              },
              {
                key: "transformSubstitution",
                value: function (t, e) {
                  return this.transformers.reduce(function (t, n) {
                    return n.onSubstitution ? n.onSubstitution(t, e) : t;
                  }, t);
                },
              },
              {
                key: "transformEndResult",
                value: function (t) {
                  return this.transformers.reduce(function (t, e) {
                    return e.onEndResult ? e.onEndResult(t) : t;
                  }, t);
                },
              },
            ]),
            t
          );
        })(),
        v = function () {
          var t =
            arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "";
          return {
            onEndResult: function (e) {
              if ("" === t) return e.trim();
              if ("start" === (t = t.toLowerCase()) || "left" === t)
                return e.replace(/^\s*/, "");
              if ("end" === t || "right" === t) return e.replace(/\s*$/, "");
              throw new Error("Side not supported: " + t);
            },
          };
        };
      function y(t) {
        if (Array.isArray(t)) {
          for (var e = 0, n = Array(t.length); e < t.length; e++) n[e] = t[e];
          return n;
        }
        return Array.from(t);
      }
      var b = function () {
          var t =
            arguments.length > 0 && void 0 !== arguments[0]
              ? arguments[0]
              : "initial";
          return {
            onEndResult: function (e) {
              if ("initial" === t) {
                var n = e.match(/^[^\S\n]*(?=\S)/gm),
                  i =
                    n &&
                    Math.min.apply(
                      Math,
                      y(
                        n.map(function (t) {
                          return t.length;
                        })
                      )
                    );
                if (i) {
                  var r = new RegExp("^.{" + i + "}", "gm");
                  return e.replace(r, "");
                }
                return e;
              }
              if ("all" === t) return e.replace(/^[^\S\n]+/gm, "");
              throw new Error("Unknown type: " + t);
            },
          };
        },
        Z = function (t, e) {
          return {
            onEndResult: function (n) {
              if (null == t || null == e)
                throw new Error(
                  "replaceResultTransformer requires at least 2 arguments."
                );
              return n.replace(t, e);
            },
          };
        },
        j = function (t, e) {
          return {
            onSubstitution: function (n, i) {
              if (null == t || null == e)
                throw new Error(
                  "replaceSubstitutionTransformer requires at least 2 arguments."
                );
              return null == n ? n : n.toString().replace(t, e);
            },
          };
        },
        S = { separator: "", conjunction: "", serial: !1 },
        w = function () {
          var t =
            arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : S;
          return {
            onSubstitution: function (e, n) {
              if (Array.isArray(e)) {
                var i = e.length,
                  r = t.separator,
                  o = t.conjunction,
                  s = t.serial,
                  a = n.match(/(\n?[^\S\n]+)$/);
                if (
                  ((e = a ? e.join(r + a[1]) : e.join(r + " ")), o && i > 1)
                ) {
                  var c = e.lastIndexOf(r);
                  e = e.slice(0, c) + (s ? r : "") + " " + o + e.slice(c + 1);
                }
              }
              return e;
            },
          };
        },
        G = function (t) {
          return {
            onSubstitution: function (e, n) {
              if (null == t || "string" != typeof t)
                throw new Error(
                  "You need to specify a string character to split by."
                );
              return (
                "string" == typeof e && e.includes(t) && (e = e.split(t)), e
              );
            },
          };
        },
        W = function (t) {
          return null != t && !Number.isNaN(t) && "boolean" != typeof t;
        },
        P = function () {
          return {
            onSubstitution: function (t) {
              return Array.isArray(t) ? t.filter(W) : W(t) ? t : "";
            },
          };
        },
        E =
          (new I(w({ separator: "," }), b, v),
          new I(w({ separator: ",", conjunction: "and" }), b, v),
          new I(w({ separator: ",", conjunction: "or" }), b, v),
          new I(G("\n"), P, w, b, v));
      new I(
        G("\n"),
        w,
        b,
        v,
        j(/&/g, "&amp;"),
        j(/</g, "&lt;"),
        j(/>/g, "&gt;"),
        j(/"/g, "&quot;"),
        j(/'/g, "&#x27;"),
        j(/`/g, "&#x60;")
      ),
        new I(Z(/(?:\n(?:\s*))+/g, " "), v),
        new I(Z(/(?:\n\s*)/g, ""), v),
        new I(w({ separator: "," }), Z(/(?:\s+)/g, " "), v),
        new I(w({ separator: ",", conjunction: "or" }), Z(/(?:\s+)/g, " "), v),
        new I(w({ separator: ",", conjunction: "and" }), Z(/(?:\s+)/g, " "), v),
        new I(w, b, v),
        new I(w, Z(/(?:\s+)/g, " "), v),
        new I(b, v),
        new I(b("all"), v);
      const R = ".freezeframe",
        Y = "ff-container",
        A = "ff-loading-icon",
        x = "ff-image",
        B = "ff-canvas",
        J = "ff-ready",
        F = "ff-inactive",
        L = "ff-active",
        k = "ff-canvas-ready",
        z = "ff-responsive",
        M = "ff-overlay",
        H = {
          selector: R,
          responsive: !0,
          trigger: "hover",
          overlay: !1,
          warnings: !0,
        };
      var T = n(1),
        X = n.n(T);
      var V,
        N,
        C,
        U = function (t, e, n, i) {
          return new (n || (n = Promise))(function (r, o) {
            function s(t) {
              try {
                c(i.next(t));
              } catch (t) {
                o(t);
              }
            }
            function a(t) {
              try {
                c(i.throw(t));
              } catch (t) {
                o(t);
              }
            }
            function c(t) {
              var e;
              t.done
                ? r(t.value)
                : ((e = t.value),
                  e instanceof n
                    ? e
                    : new n(function (t) {
                        t(e);
                      })).then(s, a);
            }
            c((i = i.apply(t, e || [])).next());
          });
        },
        O = function (t, e, n) {
          if (!e.has(t))
            throw new TypeError(
              "attempted to set private field on non-instance"
            );
          return e.set(t, n), n;
        },
        D = function (t, e) {
          if (!e.has(t))
            throw new TypeError(
              "attempted to get private field on non-instance"
            );
          return e.get(t);
        };
      (V = new WeakMap()), (N = new WeakMap()), (C = new WeakMap());
      e.default = class {
        constructor(t = R, e) {
          (this.items = []),
            (this.$images = []),
            V.set(this, void 0),
            N.set(this, void 0),
            (this._eventListeners = Object.assign(
              {},
              Object.values(i).reduce((t, e) => ((t[e] = []), t), {})
            )),
            C.set(this, []),
            "string" == typeof t ||
            t instanceof Element ||
            t instanceof HTMLCollection ||
            t instanceof NodeList
              ? ((this.options = Object.assign(Object.assign({}, H), e)),
                O(this, V, t))
              : "object" != typeof t || e
              ? a(
                  "Invalid Freezeframe.js configuration:",
                  ...[t, e].filter((t) => void 0 !== t)
                )
              : ((this.options = Object.assign(Object.assign({}, H), t)),
                O(this, V, this.options.selector)),
            this._init(D(this, V));
        }
        get _stylesInjected() {
          return !!document.querySelector("style#ff-styles");
        }
        _init(t) {
          this._injectStylesheet(),
            O(
              this,
              N,
              "ontouchstart" in window || "onmsgesturechange" in window
            ),
            this._capture(t),
            this._load(this.$images);
        }
        _capture(t) {
          this.$images = (
            (...t) =>
            (...e) =>
              t.reduceRight(
                (t, n) =>
                  (...i) =>
                    t(n(...i, ...e))
              )()
          )(
            c,
            l,
            u
          )(t, this.options);
        }
        _load(t) {
          o()(t).on("progress", (t, { img: e }) => {
            this._setup(e);
          });
        }
        _setup(t) {
          return U(this, void 0, void 0, function* () {
            const e = this._wrap(t);
            this.items.push(e), yield this._process(e), this._attach(e);
          });
        }
        _wrap(t) {
          const e = m(E`
    <div class="${Y} ${A}">
    </div>
  `),
            n = m(E`
    <canvas class="${B}" width="0" height="0">
    </canvas>
  `);
          var i, r;
          return (
            this.options.responsive && e.classList.add(z),
            this.options.overlay &&
              e.appendChild(
                m(E`
    <div class="${M}">
    </div>
  `)
              ),
            t.classList.add(x),
            e.appendChild(n),
            (r = e),
            (i = t).parentNode.insertBefore(r, i),
            r.appendChild(i),
            { $container: e, $canvas: n, $image: t }
          );
        }
        _process(t) {
          return new Promise((e) => {
            const { $canvas: n, $image: i, $container: r } = t,
              { clientWidth: o, clientHeight: s } = i;
            n.setAttribute("width", o.toString()),
              n.setAttribute("height", s.toString());
            n.getContext("2d").drawImage(i, 0, 0, o, s),
              n.classList.add(k),
              n.addEventListener(
                "transitionend",
                () => {
                  this._ready(r), e(t);
                },
                { once: !0 }
              );
          });
        }
        _ready(t) {
          t.classList.add(J), t.classList.add(F), t.classList.remove(A);
        }
        _attach(t) {
          const { $image: e } = t;
          if (!D(this, N) && "hover" === this.options.trigger) {
            const n = () => {
                this._toggleOn(t),
                  this._emit(i.START, t, !0),
                  this._emit(i.TOGGLE, t, !0);
              },
              r = () => {
                this._toggleOff(t),
                  this._emit(i.START, t, !1),
                  this._emit(i.TOGGLE, t, !1);
              };
            this._addEventListener(e, "mouseleave", r),
              this._addEventListener(e, "mouseenter", n);
          }
          if (D(this, N) || "click" === this.options.trigger) {
            const n = () => {
              this._toggle(t);
            };
            this._addEventListener(e, "click", n);
          }
        }
        _addEventListener(t, e, n) {
          D(this, C).push({ $image: t, event: e, listener: n }),
            t.addEventListener(e, n);
        }
        _removeEventListener(t, e, n) {
          t.removeEventListener(e, n);
        }
        _injectStylesheet() {
          this._stylesInjected ||
            document.head.appendChild(
              m(
                E(
                  `\n    <style id="ff-styles">\n      ${X.a.toString()}\n    </style>\n  `
                )
              )
            );
        }
        _emit(t, e, n) {
          this._eventListeners[t].forEach((t) => {
            t(Array.isArray(e) && 1 === e.length ? e[0] : e, n);
          });
        }
        _toggleOn(t) {
          const { $container: e, $image: n } = t;
          e.classList.contains(J) &&
            (n.setAttribute("src", n.src),
            e.classList.remove(F),
            e.classList.add(L));
        }
        _toggleOff(t) {
          const { $container: e } = t;
          e.classList.contains(J) &&
            (e.classList.add(F), e.classList.remove(L));
        }
        _toggle(t) {
          const { $container: e } = t,
            n = e.classList.contains(L);
          return n ? this._toggleOff(t) : this._toggleOn(t), !n;
        }
        start() {
          return (
            this.items.forEach((t) => {
              this._toggleOn(t);
            }),
            this._emit(i.START, this.items, !0),
            this._emit(i.TOGGLE, this.items, !0),
            this
          );
        }
        stop() {
          return (
            this.items.forEach((t) => {
              this._toggleOff(t);
            }),
            this._emit(i.STOP, this.items, !1),
            this._emit(i.TOGGLE, this.items, !1),
            this
          );
        }
        toggle() {
          return (
            this.items.forEach((t) => {
              const e = this._toggle(t);
              e
                ? this._emit(i.START, this.items, !1)
                : this._emit(i.STOP, this.items, !1),
                this._emit(i.TOGGLE, this.items, e);
            }),
            this
          );
        }
        on(t, e) {
          return this._eventListeners[t].push(e), this;
        }
        destroy() {
          D(this, C).forEach(({ $image: t, event: e, listener: n }) => {
            this._removeEventListener(t, e, n);
          });
        }
      };
    },
  ]).default;
});

document.addEventListener("DOMContentLoaded", function () {
  const e = new Freezeframe();
  document.getElementById("play-gif").addEventListener("click", function () { e.start() });
  document.getElementById("stop-gif").addEventListener("click", function () { e.stop() });
});