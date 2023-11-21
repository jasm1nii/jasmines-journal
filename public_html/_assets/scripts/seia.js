function y(s, t, e, i) {
  var r = arguments.length, n = r < 3 ? t : i === null ? i = Object.getOwnPropertyDescriptor(t, e) : i, o;
  if (typeof Reflect == "object" && typeof Reflect.decorate == "function")
    n = Reflect.decorate(s, t, e, i);
  else
    for (var l = s.length - 1; l >= 0; l--)
      (o = s[l]) && (n = (r < 3 ? o(n) : r > 3 ? o(t, e, n) : o(t, e)) || n);
  return r > 3 && n && Object.defineProperty(t, e, n), n;
}
const j = globalThis, K = j.ShadowRoot && (j.ShadyCSS === void 0 || j.ShadyCSS.nativeShadow) && "adoptedStyleSheets" in Document.prototype && "replace" in CSSStyleSheet.prototype, ct = Symbol(), Q = /* @__PURE__ */ new WeakMap();
let At = class {
  constructor(t, e, i) {
    if (this._$cssResult$ = !0, i !== ct)
      throw Error("CSSResult is not constructable. Use `unsafeCSS` or `css` instead.");
    this.cssText = t, this.t = e;
  }
  get styleSheet() {
    let t = this.o;
    const e = this.t;
    if (K && t === void 0) {
      const i = e !== void 0 && e.length === 1;
      i && (t = Q.get(e)), t === void 0 && ((this.o = t = new CSSStyleSheet()).replaceSync(this.cssText), i && Q.set(e, t));
    }
    return t;
  }
  toString() {
    return this.cssText;
  }
};
const pt = (s) => new At(typeof s == "string" ? s : s + "", void 0, ct), wt = (s, t) => {
  if (K)
    s.adoptedStyleSheets = t.map((e) => e instanceof CSSStyleSheet ? e : e.styleSheet);
  else
    for (const e of t) {
      const i = document.createElement("style"), r = j.litNonce;
      r !== void 0 && i.setAttribute("nonce", r), i.textContent = e.cssText, s.appendChild(i);
    }
}, X = K ? (s) => s : (s) => s instanceof CSSStyleSheet ? ((t) => {
  let e = "";
  for (const i of t.cssRules)
    e += i.cssText;
  return pt(e);
})(s) : s;
const { is: xt, defineProperty: Et, getOwnPropertyDescriptor: St, getOwnPropertyNames: kt, getOwnPropertySymbols: Ct, getPrototypeOf: Tt } = Object, A = globalThis, tt = A.trustedTypes, Pt = tt ? tt.emptyScript : "", B = A.reactiveElementPolyfillSupport, L = { toAttribute(s, t) {
  switch (t) {
    case Boolean:
      s = s ? Pt : null;
      break;
    case Object:
    case Array:
      s = s == null ? s : JSON.stringify(s);
  }
  return s;
}, fromAttribute(s, t) {
  let e = s;
  switch (t) {
    case Boolean:
      e = s !== null;
      break;
    case Number:
      e = s === null ? null : Number(s);
      break;
    case Object:
    case Array:
      try {
        e = JSON.parse(s);
      } catch {
        e = null;
      }
  }
  return e;
} }, I = (s, t) => !xt(s, t), et = { attribute: !0, type: String, converter: L, reflect: !1, hasChanged: I }, F = "finalized";
Symbol.metadata ?? (Symbol.metadata = Symbol("metadata")), A.litPropertyMetadata ?? (A.litPropertyMetadata = /* @__PURE__ */ new WeakMap());
class C extends HTMLElement {
  static addInitializer(t) {
    this._$Ei(), (this.l ?? (this.l = [])).push(t);
  }
  static get observedAttributes() {
    return this.finalize(), this._$Eh && [...this._$Eh.keys()];
  }
  static createProperty(t, e = et) {
    if (e.state && (e.attribute = !1), this._$Ei(), this.elementProperties.set(t, e), !e.noAccessor) {
      const i = Symbol(), r = this.getPropertyDescriptor(t, i, e);
      r !== void 0 && Et(this.prototype, t, r);
    }
  }
  static getPropertyDescriptor(t, e, i) {
    const { get: r, set: n } = St(this.prototype, t) ?? { get() {
      return this[e];
    }, set(o) {
      this[e] = o;
    } };
    return { get() {
      return r == null ? void 0 : r.call(this);
    }, set(o) {
      const l = r == null ? void 0 : r.call(this);
      n.call(this, o), this.requestUpdate(t, l, i);
    }, configurable: !0, enumerable: !0 };
  }
  static getPropertyOptions(t) {
    return this.elementProperties.get(t) ?? et;
  }
  static _$Ei() {
    if (this.hasOwnProperty("elementProperties"))
      return;
    const t = Tt(this);
    t.finalize(), t.l !== void 0 && (this.l = [...t.l]), this.elementProperties = new Map(t.elementProperties);
  }
  static finalize() {
    if (this.hasOwnProperty(F))
      return;
    if (this[F] = !0, this._$Ei(), this.hasOwnProperty("properties")) {
      const e = this.properties, i = [...kt(e), ...Ct(e)];
      for (const r of i)
        this.createProperty(r, e[r]);
    }
    const t = this[Symbol.metadata];
    if (t !== null) {
      const e = litPropertyMetadata.get(t);
      if (e !== void 0)
        for (const [i, r] of e)
          this.elementProperties.set(i, r);
    }
    this._$Eh = /* @__PURE__ */ new Map();
    for (const [e, i] of this.elementProperties) {
      const r = this._$Eu(e, i);
      r !== void 0 && this._$Eh.set(r, e);
    }
    this.elementStyles = this.finalizeStyles(this.styles);
  }
  static finalizeStyles(t) {
    const e = [];
    if (Array.isArray(t)) {
      const i = new Set(t.flat(1 / 0).reverse());
      for (const r of i)
        e.unshift(X(r));
    } else
      t !== void 0 && e.push(X(t));
    return e;
  }
  static _$Eu(t, e) {
    const i = e.attribute;
    return i === !1 ? void 0 : typeof i == "string" ? i : typeof t == "string" ? t.toLowerCase() : void 0;
  }
  constructor() {
    super(), this._$Ep = void 0, this.isUpdatePending = !1, this.hasUpdated = !1, this._$Em = null, this._$Ev();
  }
  _$Ev() {
    var t;
    this._$Eg = new Promise((e) => this.enableUpdating = e), this._$AL = /* @__PURE__ */ new Map(), this._$E_(), this.requestUpdate(), (t = this.constructor.l) == null || t.forEach((e) => e(this));
  }
  addController(t) {
    var e;
    (this._$ES ?? (this._$ES = [])).push(t), this.renderRoot !== void 0 && this.isConnected && ((e = t.hostConnected) == null || e.call(t));
  }
  removeController(t) {
    var e;
    (e = this._$ES) == null || e.splice(this._$ES.indexOf(t) >>> 0, 1);
  }
  _$E_() {
    const t = /* @__PURE__ */ new Map(), e = this.constructor.elementProperties;
    for (const i of e.keys())
      this.hasOwnProperty(i) && (t.set(i, this[i]), delete this[i]);
    t.size > 0 && (this._$Ep = t);
  }
  createRenderRoot() {
    const t = this.shadowRoot ?? this.attachShadow(this.constructor.shadowRootOptions);
    return wt(t, this.constructor.elementStyles), t;
  }
  connectedCallback() {
    var t;
    this.renderRoot === void 0 && (this.renderRoot = this.createRenderRoot()), this.enableUpdating(!0), (t = this._$ES) == null || t.forEach((e) => {
      var i;
      return (i = e.hostConnected) == null ? void 0 : i.call(e);
    });
  }
  enableUpdating(t) {
  }
  disconnectedCallback() {
    var t;
    (t = this._$ES) == null || t.forEach((e) => {
      var i;
      return (i = e.hostDisconnected) == null ? void 0 : i.call(e);
    });
  }
  attributeChangedCallback(t, e, i) {
    this._$AK(t, i);
  }
  _$EO(t, e) {
    var n;
    const i = this.constructor.elementProperties.get(t), r = this.constructor._$Eu(t, i);
    if (r !== void 0 && i.reflect === !0) {
      const o = (((n = i.converter) == null ? void 0 : n.toAttribute) !== void 0 ? i.converter : L).toAttribute(e, i.type);
      this._$Em = t, o == null ? this.removeAttribute(r) : this.setAttribute(r, o), this._$Em = null;
    }
  }
  _$AK(t, e) {
    var n;
    const i = this.constructor, r = i._$Eh.get(t);
    if (r !== void 0 && this._$Em !== r) {
      const o = i.getPropertyOptions(r), l = typeof o.converter == "function" ? { fromAttribute: o.converter } : ((n = o.converter) == null ? void 0 : n.fromAttribute) !== void 0 ? o.converter : L;
      this._$Em = r, this[r] = l.fromAttribute(e, o.type), this._$Em = null;
    }
  }
  requestUpdate(t, e, i, r = !1, n) {
    if (t !== void 0) {
      if (i ?? (i = this.constructor.getPropertyOptions(t)), !(i.hasChanged ?? I)(r ? n : this[t], e))
        return;
      this.C(t, e, i);
    }
    this.isUpdatePending === !1 && (this._$Eg = this._$EP());
  }
  C(t, e, i) {
    this._$AL.has(t) || this._$AL.set(t, e), i.reflect === !0 && this._$Em !== t && (this._$Ej ?? (this._$Ej = /* @__PURE__ */ new Set())).add(t);
  }
  async _$EP() {
    this.isUpdatePending = !0;
    try {
      await this._$Eg;
    } catch (e) {
      Promise.reject(e);
    }
    const t = this.scheduleUpdate();
    return t != null && await t, !this.isUpdatePending;
  }
  scheduleUpdate() {
    return this.performUpdate();
  }
  performUpdate() {
    var i;
    if (!this.isUpdatePending)
      return;
    if (!this.hasUpdated) {
      if (this._$Ep) {
        for (const [n, o] of this._$Ep)
          this[n] = o;
        this._$Ep = void 0;
      }
      const r = this.constructor.elementProperties;
      if (r.size > 0)
        for (const [n, o] of r)
          o.wrapped !== !0 || this._$AL.has(n) || this[n] === void 0 || this.C(n, this[n], o);
    }
    let t = !1;
    const e = this._$AL;
    try {
      t = this.shouldUpdate(e), t ? (this.willUpdate(e), (i = this._$ES) == null || i.forEach((r) => {
        var n;
        return (n = r.hostUpdate) == null ? void 0 : n.call(r);
      }), this.update(e)) : this._$ET();
    } catch (r) {
      throw t = !1, this._$ET(), r;
    }
    t && this._$AE(e);
  }
  willUpdate(t) {
  }
  _$AE(t) {
    var e;
    (e = this._$ES) == null || e.forEach((i) => {
      var r;
      return (r = i.hostUpdated) == null ? void 0 : r.call(i);
    }), this.hasUpdated || (this.hasUpdated = !0, this.firstUpdated(t)), this.updated(t);
  }
  _$ET() {
    this._$AL = /* @__PURE__ */ new Map(), this.isUpdatePending = !1;
  }
  get updateComplete() {
    return this.getUpdateComplete();
  }
  getUpdateComplete() {
    return this._$Eg;
  }
  shouldUpdate(t) {
    return !0;
  }
  update(t) {
    this._$Ej && (this._$Ej = this._$Ej.forEach((e) => this._$EO(e, this[e]))), this._$ET();
  }
  updated(t) {
  }
  firstUpdated(t) {
  }
}
C[F] = !0, C.elementProperties = /* @__PURE__ */ new Map(), C.elementStyles = [], C.shadowRootOptions = { mode: "open" }, B == null || B({ ReactiveElement: C }), (A.reactiveElementVersions ?? (A.reactiveElementVersions = [])).push("2.0.0-pre.1");
const U = globalThis, D = U.trustedTypes, it = D ? D.createPolicy("lit-html", { createHTML: (s) => s }) : void 0, Y = "$lit$", v = `lit$${(Math.random() + "").slice(9)}$`, G = "?" + v, Ut = `<${G}>`, S = document, N = () => S.createComment(""), R = (s) => s === null || typeof s != "object" && typeof s != "function", ut = Array.isArray, dt = (s) => ut(s) || typeof (s == null ? void 0 : s[Symbol.iterator]) == "function", V = `[ 	
\f\r]`, P = /<(?:(!--|\/[^a-zA-Z])|(\/?[a-zA-Z][^>\s]*)|(\/?$))/g, rt = /-->/g, st = />/g, x = RegExp(`>|${V}(?:([^\\s"'>=/]+)(${V}*=${V}*(?:[^ 	
\f\r"'\`<>=]|("|')|))|$)`, "g"), nt = /'/g, ot = /"/g, gt = /^(?:script|style|textarea|title)$/i, Mt = (s) => (t, ...e) => ({ _$litType$: s, strings: t, values: e }), Nt = Mt(1), w = Symbol.for("lit-noChange"), p = Symbol.for("lit-nothing"), at = /* @__PURE__ */ new WeakMap(), E = S.createTreeWalker(S, 129);
function mt(s, t) {
  if (!Array.isArray(s) || !s.hasOwnProperty("raw"))
    throw Error("invalid template strings array");
  return it !== void 0 ? it.createHTML(t) : t;
}
const ft = (s, t) => {
  const e = s.length - 1, i = [];
  let r, n = t === 2 ? "<svg>" : "", o = P;
  for (let l = 0; l < e; l++) {
    const a = s[l];
    let c, u, h = -1, b = 0;
    for (; b < a.length && (o.lastIndex = b, u = o.exec(a), u !== null); )
      b = o.lastIndex, o === P ? u[1] === "!--" ? o = rt : u[1] !== void 0 ? o = st : u[2] !== void 0 ? (gt.test(u[2]) && (r = RegExp("</" + u[2], "g")), o = x) : u[3] !== void 0 && (o = x) : o === x ? u[0] === ">" ? (o = r ?? P, h = -1) : u[1] === void 0 ? h = -2 : (h = o.lastIndex - u[2].length, c = u[1], o = u[3] === void 0 ? x : u[3] === '"' ? ot : nt) : o === ot || o === nt ? o = x : o === rt || o === st ? o = P : (o = x, r = void 0);
    const _ = o === x && s[l + 1].startsWith("/>") ? " " : "";
    n += o === P ? a + Ut : h >= 0 ? (i.push(c), a.slice(0, h) + Y + a.slice(h) + v + _) : a + v + (h === -2 ? l : _);
  }
  return [mt(s, n + (s[e] || "<?>") + (t === 2 ? "</svg>" : "")), i];
};
class z {
  constructor({ strings: t, _$litType$: e }, i) {
    let r;
    this.parts = [];
    let n = 0, o = 0;
    const l = t.length - 1, a = this.parts, [c, u] = ft(t, e);
    if (this.el = z.createElement(c, i), E.currentNode = this.el.content, e === 2) {
      const h = this.el.content.firstChild;
      h.replaceWith(...h.childNodes);
    }
    for (; (r = E.nextNode()) !== null && a.length < l; ) {
      if (r.nodeType === 1) {
        if (r.hasAttributes())
          for (const h of r.getAttributeNames())
            if (h.endsWith(Y)) {
              const b = u[o++], _ = r.getAttribute(h).split(v), O = /([.?@])?(.*)/.exec(b);
              a.push({ type: 1, index: n, name: O[2], strings: _, ctor: O[1] === "." ? bt : O[1] === "?" ? vt : O[1] === "@" ? $t : H }), r.removeAttribute(h);
            } else
              h.startsWith(v) && (a.push({ type: 6, index: n }), r.removeAttribute(h));
        if (gt.test(r.tagName)) {
          const h = r.textContent.split(v), b = h.length - 1;
          if (b > 0) {
            r.textContent = D ? D.emptyScript : "";
            for (let _ = 0; _ < b; _++)
              r.append(h[_], N()), E.nextNode(), a.push({ type: 2, index: ++n });
            r.append(h[b], N());
          }
        }
      } else if (r.nodeType === 8)
        if (r.data === G)
          a.push({ type: 2, index: n });
        else {
          let h = -1;
          for (; (h = r.data.indexOf(v, h + 1)) !== -1; )
            a.push({ type: 7, index: n }), h += v.length - 1;
        }
      n++;
    }
  }
  static createElement(t, e) {
    const i = S.createElement("template");
    return i.innerHTML = t, i;
  }
}
function k(s, t, e = s, i) {
  var o, l;
  if (t === w)
    return t;
  let r = i !== void 0 ? (o = e._$Co) == null ? void 0 : o[i] : e._$Cl;
  const n = R(t) ? void 0 : t._$litDirective$;
  return (r == null ? void 0 : r.constructor) !== n && ((l = r == null ? void 0 : r._$AO) == null || l.call(r, !1), n === void 0 ? r = void 0 : (r = new n(s), r._$AT(s, e, i)), i !== void 0 ? (e._$Co ?? (e._$Co = []))[i] = r : e._$Cl = r), r !== void 0 && (t = k(s, r._$AS(s, t.values), r, i)), t;
}
class yt {
  constructor(t, e) {
    this._$AV = [], this._$AN = void 0, this._$AD = t, this._$AM = e;
  }
  get parentNode() {
    return this._$AM.parentNode;
  }
  get _$AU() {
    return this._$AM._$AU;
  }
  u(t) {
    const { el: { content: e }, parts: i } = this._$AD, r = ((t == null ? void 0 : t.creationScope) ?? S).importNode(e, !0);
    E.currentNode = r;
    let n = E.nextNode(), o = 0, l = 0, a = i[0];
    for (; a !== void 0; ) {
      if (o === a.index) {
        let c;
        a.type === 2 ? c = new T(n, n.nextSibling, this, t) : a.type === 1 ? c = new a.ctor(n, a.name, a.strings, this, t) : a.type === 6 && (c = new _t(n, this, t)), this._$AV.push(c), a = i[++l];
      }
      o !== (a == null ? void 0 : a.index) && (n = E.nextNode(), o++);
    }
    return E.currentNode = S, r;
  }
  p(t) {
    let e = 0;
    for (const i of this._$AV)
      i !== void 0 && (i.strings !== void 0 ? (i._$AI(t, i, e), e += i.strings.length - 2) : i._$AI(t[e])), e++;
  }
}
class T {
  get _$AU() {
    var t;
    return ((t = this._$AM) == null ? void 0 : t._$AU) ?? this._$Cv;
  }
  constructor(t, e, i, r) {
    this.type = 2, this._$AH = p, this._$AN = void 0, this._$AA = t, this._$AB = e, this._$AM = i, this.options = r, this._$Cv = (r == null ? void 0 : r.isConnected) ?? !0;
  }
  get parentNode() {
    let t = this._$AA.parentNode;
    const e = this._$AM;
    return e !== void 0 && (t == null ? void 0 : t.nodeType) === 11 && (t = e.parentNode), t;
  }
  get startNode() {
    return this._$AA;
  }
  get endNode() {
    return this._$AB;
  }
  _$AI(t, e = this) {
    t = k(this, t, e), R(t) ? t === p || t == null || t === "" ? (this._$AH !== p && this._$AR(), this._$AH = p) : t !== this._$AH && t !== w && this._(t) : t._$litType$ !== void 0 ? this.g(t) : t.nodeType !== void 0 ? this.$(t) : dt(t) ? this.T(t) : this._(t);
  }
  k(t) {
    return this._$AA.parentNode.insertBefore(t, this._$AB);
  }
  $(t) {
    this._$AH !== t && (this._$AR(), this._$AH = this.k(t));
  }
  _(t) {
    this._$AH !== p && R(this._$AH) ? this._$AA.nextSibling.data = t : this.$(S.createTextNode(t)), this._$AH = t;
  }
  g(t) {
    var n;
    const { values: e, _$litType$: i } = t, r = typeof i == "number" ? this._$AC(t) : (i.el === void 0 && (i.el = z.createElement(mt(i.h, i.h[0]), this.options)), i);
    if (((n = this._$AH) == null ? void 0 : n._$AD) === r)
      this._$AH.p(e);
    else {
      const o = new yt(r, this), l = o.u(this.options);
      o.p(e), this.$(l), this._$AH = o;
    }
  }
  _$AC(t) {
    let e = at.get(t.strings);
    return e === void 0 && at.set(t.strings, e = new z(t)), e;
  }
  T(t) {
    ut(this._$AH) || (this._$AH = [], this._$AR());
    const e = this._$AH;
    let i, r = 0;
    for (const n of t)
      r === e.length ? e.push(i = new T(this.k(N()), this.k(N()), this, this.options)) : i = e[r], i._$AI(n), r++;
    r < e.length && (this._$AR(i && i._$AB.nextSibling, r), e.length = r);
  }
  _$AR(t = this._$AA.nextSibling, e) {
    var i;
    for ((i = this._$AP) == null ? void 0 : i.call(this, !1, !0, e); t && t !== this._$AB; ) {
      const r = t.nextSibling;
      t.remove(), t = r;
    }
  }
  setConnected(t) {
    var e;
    this._$AM === void 0 && (this._$Cv = t, (e = this._$AP) == null || e.call(this, t));
  }
}
class H {
  get tagName() {
    return this.element.tagName;
  }
  get _$AU() {
    return this._$AM._$AU;
  }
  constructor(t, e, i, r, n) {
    this.type = 1, this._$AH = p, this._$AN = void 0, this.element = t, this.name = e, this._$AM = r, this.options = n, i.length > 2 || i[0] !== "" || i[1] !== "" ? (this._$AH = Array(i.length - 1).fill(new String()), this.strings = i) : this._$AH = p;
  }
  _$AI(t, e = this, i, r) {
    const n = this.strings;
    let o = !1;
    if (n === void 0)
      t = k(this, t, e, 0), o = !R(t) || t !== this._$AH && t !== w, o && (this._$AH = t);
    else {
      const l = t;
      let a, c;
      for (t = n[0], a = 0; a < n.length - 1; a++)
        c = k(this, l[i + a], e, a), c === w && (c = this._$AH[a]), o || (o = !R(c) || c !== this._$AH[a]), c === p ? t = p : t !== p && (t += (c ?? "") + n[a + 1]), this._$AH[a] = c;
    }
    o && !r && this.j(t);
  }
  j(t) {
    t === p ? this.element.removeAttribute(this.name) : this.element.setAttribute(this.name, t ?? "");
  }
}
class bt extends H {
  constructor() {
    super(...arguments), this.type = 3;
  }
  j(t) {
    this.element[this.name] = t === p ? void 0 : t;
  }
}
class vt extends H {
  constructor() {
    super(...arguments), this.type = 4;
  }
  j(t) {
    this.element.toggleAttribute(this.name, !!t && t !== p);
  }
}
class $t extends H {
  constructor(t, e, i, r, n) {
    super(t, e, i, r, n), this.type = 5;
  }
  _$AI(t, e = this) {
    if ((t = k(this, t, e, 0) ?? p) === w)
      return;
    const i = this._$AH, r = t === p && i !== p || t.capture !== i.capture || t.once !== i.once || t.passive !== i.passive, n = t !== p && (i === p || r);
    r && this.element.removeEventListener(this.name, this, i), n && this.element.addEventListener(this.name, this, t), this._$AH = t;
  }
  handleEvent(t) {
    var e;
    typeof this._$AH == "function" ? this._$AH.call(((e = this.options) == null ? void 0 : e.host) ?? this.element, t) : this._$AH.handleEvent(t);
  }
}
class _t {
  constructor(t, e, i) {
    this.element = t, this.type = 6, this._$AN = void 0, this._$AM = e, this.options = i;
  }
  get _$AU() {
    return this._$AM._$AU;
  }
  _$AI(t) {
    k(this, t);
  }
}
const d = { S: Y, A: v, P: G, C: 1, M: ft, L: yt, R: dt, V: k, D: T, I: H, H: vt, N: $t, U: bt, B: _t }, q = U.litHtmlPolyfillSupport;
q == null || q(z, T), (U.litHtmlVersions ?? (U.litHtmlVersions = [])).push("3.0.0-pre.1");
const Rt = (s, t, e) => {
  const i = (e == null ? void 0 : e.renderBefore) ?? t;
  let r = i._$litPart$;
  if (r === void 0) {
    const n = (e == null ? void 0 : e.renderBefore) ?? null;
    i._$litPart$ = r = new T(t.insertBefore(N(), n), n, void 0, e ?? {});
  }
  return r._$AI(s), r;
};
class M extends C {
  constructor() {
    super(...arguments), this.renderOptions = { host: this }, this._$Do = void 0;
  }
  createRenderRoot() {
    var e;
    const t = super.createRenderRoot();
    return (e = this.renderOptions).renderBefore ?? (e.renderBefore = t.firstChild), t;
  }
  update(t) {
    const e = this.render();
    this.hasUpdated || (this.renderOptions.isConnected = this.isConnected), super.update(t), this._$Do = Rt(e, this.renderRoot, this.renderOptions);
  }
  connectedCallback() {
    var t;
    super.connectedCallback(), (t = this._$Do) == null || t.setConnected(!0);
  }
  disconnectedCallback() {
    var t;
    super.disconnectedCallback(), (t = this._$Do) == null || t.setConnected(!1);
  }
  render() {
    return w;
  }
}
var ht;
M.finalized = !0, M._$litElement$ = !0, (ht = globalThis.litElementHydrateSupport) == null || ht.call(globalThis, { LitElement: M });
const W = globalThis.litElementPolyfillSupport;
W == null || W({ LitElement: M });
(globalThis.litElementVersions ?? (globalThis.litElementVersions = [])).push("4.0.0-pre.1");
const zt = (s) => (t, e) => {
  e !== void 0 ? e.addInitializer(() => {
    customElements.define(s, t);
  }) : customElements.define(s, t);
};
const Ht = { attribute: !0, type: String, converter: L, reflect: !1, hasChanged: I }, Ot = (s = Ht, t, e) => {
  const { kind: i, metadata: r } = e;
  let n = globalThis.litPropertyMetadata.get(r);
  if (n === void 0 && globalThis.litPropertyMetadata.set(r, n = /* @__PURE__ */ new Map()), n.set(e.name, s), i === "accessor") {
    const { name: o } = e;
    return { set(l) {
      const a = t.get.call(this);
      t.set.call(this, l), this.requestUpdate(o, a, s);
    }, init(l) {
      return l !== void 0 && this.C(o, void 0, s), l;
    } };
  }
  if (i === "setter") {
    const { name: o } = e;
    return function(l) {
      const a = this[o];
      t.call(this, l), this.requestUpdate(o, a, s);
    };
  }
  throw Error("Unsupported decorator location: " + i);
};
function $(s) {
  return (t, e) => typeof e == "object" ? Ot(s, t, e) : ((i, r, n) => {
    const o = r.hasOwnProperty(n);
    return r.constructor.createProperty(n, o ? { ...i, wrapped: !0 } : i), o ? Object.getOwnPropertyDescriptor(r, n) : void 0;
  })(s, t, e);
}
const jt = { ATTRIBUTE: 1, CHILD: 2, PROPERTY: 3, BOOLEAN_ATTRIBUTE: 4, EVENT: 5, ELEMENT: 6 }, Lt = (s) => (...t) => ({ _$litDirective$: s, values: t });
let Dt = class {
  constructor(t) {
  }
  get _$AU() {
    return this._$AM._$AU;
  }
  _$AT(t, e, i) {
    this._$Ct = t, this._$AM = e, this._$Ci = i;
  }
  _$AS(t, e) {
    return this.update(t, e);
  }
  update(t, e) {
    return this.render(...e);
  }
};
class J extends Dt {
  constructor(t) {
    if (super(t), this.et = p, t.type !== jt.CHILD)
      throw Error(this.constructor.directiveName + "() can only be used in child bindings");
  }
  render(t) {
    if (t === p || t == null)
      return this.vt = void 0, this.et = t;
    if (t === w)
      return t;
    if (typeof t != "string")
      throw Error(this.constructor.directiveName + "() called with a non-string value");
    if (t === this.et)
      return this.vt;
    this.et = t;
    const e = [t];
    return e.raw = e, this.vt = { _$litType$: this.constructor.resultType, strings: e, values: [] };
  }
}
J.directiveName = "unsafeHTML", J.resultType = 1;
const It = Lt(J);
const Bt = Symbol();
class Vt {
  get taskComplete() {
    return this.t || (this.status === 1 ? this.t = new Promise((t, e) => {
      this.i = t, this.o = e;
    }) : this.status === 3 ? this.t = Promise.reject(this.h) : this.t = Promise.resolve(this.l)), this.t;
  }
  constructor(t, e, i) {
    var n;
    this.u = 0, this.status = 0, (this.p = t).addController(this);
    const r = typeof e == "object" ? e : { task: e, args: i };
    this._ = r.task, this.v = r.args, this.j = r.argsEqual ?? qt, this.m = r.onComplete, this.g = r.onError, this.autoRun = r.autoRun ?? !0, "initialValue" in r && (this.l = r.initialValue, this.status = 2, this.k = (n = this.A) == null ? void 0 : n.call(this));
  }
  hostUpdate() {
    this.autoRun === !0 && this.O();
  }
  hostUpdated() {
    this.autoRun === "afterUpdate" && this.O();
  }
  A() {
    if (this.v === void 0)
      return;
    const t = this.v();
    if (!Array.isArray(t))
      throw Error("The args function must return an array");
    return t;
  }
  async O() {
    const t = this.A(), e = this.k;
    this.k = t, t === e || t === void 0 || e !== void 0 && this.j(e, t) || await this.run(t);
  }
  async run(t) {
    var o, l, a, c, u;
    let e, i;
    t ?? (t = this.A()), this.k = t, this.status === 1 ? (o = this.T) == null || o.abort() : (this.t = void 0, this.i = void 0, this.o = void 0), this.status = 1, this.autoRun === "afterUpdate" ? queueMicrotask(() => this.p.requestUpdate()) : this.p.requestUpdate();
    const r = ++this.u;
    this.T = new AbortController();
    let n = !1;
    try {
      e = await this._(t, { signal: this.T.signal });
    } catch (h) {
      n = !0, i = h;
    }
    if (this.u === r) {
      if (e === Bt)
        this.status = 0;
      else {
        if (n === !1) {
          try {
            (l = this.m) == null || l.call(this, e);
          } catch {
          }
          this.status = 2, (a = this.i) == null || a.call(this, e);
        } else {
          try {
            (c = this.g) == null || c.call(this, i);
          } catch {
          }
          this.status = 3, (u = this.o) == null || u.call(this, i);
        }
        this.l = e, this.h = i;
      }
      this.p.requestUpdate();
    }
  }
  abort(t) {
    var e;
    this.status === 1 && ((e = this.T) == null || e.abort(t));
  }
  get value() {
    return this.l;
  }
  get error() {
    return this.h;
  }
  render(t) {
    var e, i, r, n;
    switch (this.status) {
      case 0:
        return (e = t.initial) == null ? void 0 : e.call(t);
      case 1:
        return (i = t.pending) == null ? void 0 : i.call(t);
      case 2:
        return (r = t.complete) == null ? void 0 : r.call(t, this.value);
      case 3:
        return (n = t.error) == null ? void 0 : n.call(t, this.error);
      default:
        throw Error("Unexpected status: " + this.status);
    }
  }
}
const qt = (s, t) => s === t || s.length === t.length && s.every((e, i) => !I(e, t[i])), Wt = `
  *,:before,:after{
    box-sizing:border-box;border-width:0;border-style:solid;border-color:var(--un-default-border-color, #e5e7eb)
  }
  html{
    line-height:1.5;-webkit-text-size-adjust:100%;text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,"Apple Color Emoji","Segoe UI Emoji",Segoe UI Symbol,"Noto Color Emoji"
  }
  body{
    margin:0;line-height:inherit
  }
  hr{
    height:0;color:inherit;border-top-width:1px
  }
  abbr:where([title]){
    text-decoration:underline dotted
  }
  h1,h2,h3,h4,h5,h6{
    font-size:inherit;font-weight:inherit
  }
  a{
    color:inherit;text-decoration:inherit
  }
  b,strong{
    font-weight:bolder
  }
  code,kbd,samp,pre{
    font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;font-size:1em
  }
  small{
    font-size:80%
  }
  sub,sup{
    font-size:75%;line-height:0;position:relative;vertical-align:baseline
  }
  sub{
    bottom:-.25em
  }
  sup{
    top:-.5em
  }
  table{
    text-indent:0;border-color:inherit;border-collapse:collapse
  }
  button,input,optgroup,select,textarea{
    font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0
  }
  button,select{
    text-transform:none
  }
  button,[type=button],[type=reset],[type=submit]{
    -webkit-appearance:button;background-color:transparent;background-image:none
  }
  :-moz-focusring{
    outline:auto
  }
  :-moz-ui-invalid{
    box-shadow:none
  }
  progress{
    vertical-align:baseline
  }
  ::-webkit-inner-spin-button,::-webkit-outer-spin-button{
    height:auto
  }
  [type=search]{
    -webkit-appearance:textfield;outline-offset:-2px
  }
  ::-webkit-search-decoration{
    -webkit-appearance:none
  }
  ::-webkit-file-upload-button{
    -webkit-appearance:button;font:inherit
  }
  summary{
    display:list-item
  }
  blockquote,dl,dd,h1,h2,h3,h4,h5,h6,hr,figure,p,pre{
    margin:0
  }
  fieldset{
    margin:0;padding:0
  }
  legend{
    padding:0
  }
  ol,ul,menu{
    list-style:none;margin:0;padding:0
  }
  textarea{
    resize:vertical
  }
  input::placeholder,textarea::placeholder{
    opacity:1;color:#9ca3af
  }
  button,[role=button]{
    cursor:pointer
  }
  :disabled{
    cursor:default
  }
  img,svg,video,canvas,audio,iframe,embed,object{
    display:block;vertical-align:middle
  }
    img,video{
      max-width:100%;height:auto
    }
    [hidden]{
      display:none
    }
`, Zt = (s) => s.filter(({ data: t }) => {
  var e;
  return (e = t.author) == null ? void 0 : e.name;
}).reduce(
  (t, e) => ({
    ...t,
    [e.data.content ? "content" : "avatar"]: [
      ...t[e.data.content ? "content" : "avatar"],
      e
    ]
  }),
  {
    avatar: [],
    content: []
  }
), lt = {
  like: "👍",
  reply: "💬",
  repost: "♻️",
  bookmark: "🔖",
  rsvp: "💌",
  invite: "📨",
  link: "🔗"
};
const Ft = { boundAttributeSuffix: d.S, marker: d.A, markerMatch: d.P, HTML_RESULT: d.C, getTemplateHtml: d.M, overrideDirectiveResolve: (s, t) => class extends s {
  _$AS(e, i) {
    return t(this, i);
  }
}, setDirectiveClass(s, t) {
  s._$litDirective$ = t;
}, getAttributePartCommittedValue: (s, t, e) => {
  let i = w;
  return s.j = (r) => i = r, s._$AI(t, s, e), i;
}, connectedDisconnectable: (s) => ({ ...s, _$AU: !0 }), resolveDirective: d.V, AttributePart: d.I, PropertyPart: d.U, BooleanAttributePart: d.H, EventPart: d.N, ElementPart: d.B, TemplateInstance: d.L, isIterable: d.R, ChildPart: d.D };
var Z;
const { AttributePart: m } = Ft, g = (s) => s, Jt = { h: g`<i-svg-spinners-90-ring-with-bg w-12="" h-12="" mx-auto="" my-4="" text="seia-primary"></i-svg-spinners-90-ring-with-bg>`, parts: [] }, Kt = { h: g`<i-svg-spinners-270-ring-with-bg w-12="" h-12="" mx-auto="" my-4="" text="seia-primary"></i-svg-spinners-270-ring-with-bg>`, parts: [] }, Yt = { h: g`\n              <?>\n              <?>\n              <?>\n            `, parts: [{ type: 2, index: 0 }, { type: 2, index: 1 }, { type: 2, index: 2 }] }, Gt = { h: g`\n                    <div id="seia-avatar-container" flex="~ row-reverse wrap" space-x="-2 reverse" gap="y-2" p-4="" bg="seia-bg" justify="end" rounded="card">\n                      <?>\n                    </div>\n                  `, parts: [{ type: 2, index: 1 }] }, Qt = { h: g`\n                          <div shrink="0" hover="z-10">\n                            <a class="u-url">\n                              <figure relative="" class="p-author h-card">\n                                <img w-12="" h-12="" mb-auto="" transition="" bg="seia-bg" rounded="avatar" ring="2 seia-bg group-hover:seia-primary" class="u-photo">\n                                <span absolute="" bottom="0" right="0"><?></span>\n                              </figure>\n                            </a>\n                            <?>\n                          </div>\n                        `, parts: [{ type: 1, index: 0, name: "class", strings: ["", "h-cite group"], ctor: m }, { type: 1, index: 1, name: "href", strings: ["", ""], ctor: m }, { type: 1, index: 3, name: "alt", strings: ["", ""], ctor: m }, { type: 1, index: 3, name: "src", strings: ["", ""], ctor: m }, { type: 2, index: 5 }, { type: 2, index: 6 }] }, Xt = { h: g`\n                              <a class="p-name u-url" hidden=""><?></a>\n                            `, parts: [{ type: 1, index: 0, name: "href", strings: ["", ""], ctor: m }, { type: 2, index: 1 }] }, te = { h: g`\n                    <div id="seia-content-container" flex="~ col" gap="2">\n                      <?>\n                    </div>\n                  `, parts: [{ type: 2, index: 1 }] }, ee = { h: g`\n                          <div p-4="" bg="seia-bg" rounded="card" class="p-comment h-cite">\n                            <div flex="" items-center="" gap="3" mb-4="" class="p-author h-card">\n                              <figure relative="">\n                                <img w-12="" h-12="" mb-auto="" rounded="avatar" class="u-photo">\n                                <span absolute="" bottom="0" right="0"><?></span>\n                              </figure>\n                              <div flex="~ col" break-all="">\n                                <?>\n                                <span opacity-75="">\n                                  <?>\n                                  <a transition="" hover="underline text-seia-primary" class="u-url">\n                                    <time class="dt-published"><?></time>\n                                  </a>\n                                </span>\n                              </div>\n                            </div>\n                            <!-- TODO: p-r-o-s-e (unocss/unocss#2189) -->\n                            <div class="e-content">\n                              <?>\n                            </div>\n                          </div>\n                        `, parts: [{ type: 1, index: 3, name: "alt", strings: ["", ""], ctor: m }, { type: 1, index: 3, name: "src", strings: ["", ""], ctor: m }, { type: 2, index: 5 }, { type: 2, index: 7 }, { type: 2, index: 9 }, { type: 1, index: 10, name: "href", strings: ["", ""], ctor: m }, { type: 1, index: 11, name: "datetime", strings: ["", ""], ctor: m }, { type: 2, index: 12 }, { type: 2, index: 15 }] }, ie = { h: g`<a font="bold" class="p-name u-url"><?></a>`, parts: [{ type: 1, index: 0, name: "href", strings: ["", ""], ctor: m }, { type: 2, index: 1 }] }, re = { h: g`<span font="bold" class="p-name"><?></span>`, parts: [{ type: 2, index: 1 }] }, se = { h: g`<a transition="" hover="underline text-seia-primary" class="u-url"><?></a>\n                                    <span>\u00B7</span>`, parts: [{ type: 1, index: 0, name: "href", strings: ["", ""], ctor: m }, { type: 2, index: 1 }] }, ne = { h: g`<?><!--?-->`, parts: [{ type: 2, index: 0 }] }, oe = { h: g`<span ml-auto="" mr-2="" text="sm">Powered by\n                    <?>\n                    <a href="https://github.com/importantimport/seia" rel="noopener noreferrer" target="_blank" text="seia-primary" hover="underline">Seia</a></span>`, parts: [{ type: 2, index: 1 }] }, ae = { h: g`<a href="https://webmention.io" rel="noopener noreferrer" target="_blank" text="seia-primary" hover="underline">Webmention.io</a>\n                          &amp;`, parts: [] };
let f = (Z = class extends M {
  constructor() {
    super(...arguments), this.api = "https://webmention.io/api/mentions.json", this.css = "", this["powered-by"] = !0, this["unsafe-html"] = !0, this["sort-by"] = "created", this["sort-dir"] = "down", this["per-page"] = 99, this.target = (() => {
      try {
        const s = new URL(globalThis.location.href);
        return s.search = "", s.toString();
      } catch {
        throw new Error("invalid URL");
      }
    })(), this["fallback-photo"] = "https://ui-avatars.com/api/?name=%NAME%&background=random&format=svg", this.mentions = new Vt(this, {
      args: () => [this.target],
      task: async ([s]) => fetch(`${this.api}?${new URLSearchParams({
        target: s,
        page: "0",
        "per-page": this["per-page"].toString(),
        "sort-by": this["sort-by"],
        "sort-dir": this["sort-dir"]
      }).toString()}`).then((t) => t.json()).catch(console.error)
    });
  }
  render() {
    return Nt`<style>${this.css}</style><div id="seia-container" flex="~ col" gap="2" text="seia-text">${this.mentions.render({
      initial: () => ({ _$litType$: Jt, values: [] }),
      pending: () => ({ _$litType$: Kt, values: [] }),
      // eslint-disable-next-line no-console
      error: console.error,
      complete: ({ links: s }) => {
        const { avatar: t, content: e } = Zt(s);
        return { _$litType$: Yt, values: [t.length > 0 ? { _$litType$: Gt, values: [t.map(({ activity: i, data: { author: r, url: n } }) => ({ _$litType$: Qt, values: [i.type === "like" ? "p-like " : "", n, r.name, r.photo ?? this["fallback-photo"].replace("%NAME%", encodeURIComponent(r.name)), lt[i.type], r.url && { _$litType$: Xt, values: [r.url, r.name] }] }))] } : null, e.length > 0 ? { _$litType$: te, values: [e.map(({
          activity: i,
          data: { author: r, content: n, url: o },
          // eslint-disable-next-line camelcase
          verified_date: l
        }) => ({ _$litType$: ee, values: [
          r.name,
          r.photo ?? this["fallback-photo"].replace("%NAME%", encodeURIComponent(r.name)),
          lt[i.type],
          r.url ? { _$litType$: ie, values: [r.url, r.name] } : { _$litType$: re, values: [r.name] },
          r.url && { _$litType$: se, values: [r.url, r.url.split("://")[1].replace(/\/$/, "")] },
          o,
          // eslint-disable-next-line camelcase
          l,
          new Date(l).toLocaleDateString(),
          { _$litType$: ne, values: [this["unsafe-html"] ? It(n) : n] }
        ] }))] } : null, this["powered-by"] ? { _$litType$: oe, values: [this.api.includes("webmention.io") ? { _$litType$: ae, values: [] } : ""] } : ""] };
      }
    })}</div>`;
  }
}, Z.styles = pt(`${Wt}/* layer: preflights */
*,::before,::after{
  --un-rotate:0;--un-rotate-x:0;--un-rotate-y:0;--un-rotate-z:0;--un-scale-x:1;--un-scale-y:1;--un-scale-z:1;--un-skew-x:0;--un-skew-y:0;--un-translate-x:0;--un-translate-y:0;--un-translate-z:0;--un-pan-x: ;--un-pan-y: ;--un-pinch-zoom: ;--un-scroll-snap-strictness:proximity;--un-ordinal: ;--un-slashed-zero: ;--un-numeric-figure: ;--un-numeric-spacing: ;--un-numeric-fraction: ;--un-border-spacing-x:0;--un-border-spacing-y:0;--un-ring-offset-shadow:0 0 rgba(0,0,0,0);--un-ring-shadow:0 0 rgba(0,0,0,0);--un-shadow-inset: ;--un-shadow:0 0 rgba(0,0,0,0);--un-ring-inset: ;--un-ring-offset-width:0px;--un-ring-offset-color:#fff;--un-ring-width:0px;--un-ring-color:rgba(147,197,253,0.5);--un-blur: ;--un-brightness: ;--un-contrast: ;--un-drop-shadow: ;--un-grayscale: ;--un-hue-rotate: ;--un-invert: ;--un-saturate: ;--un-sepia: ;--un-backdrop-blur: ;--un-backdrop-brightness: ;--un-backdrop-contrast: ;--un-backdrop-grayscale: ;--un-backdrop-hue-rotate: ;--un-backdrop-invert: ;--un-backdrop-opacity: ;--un-backdrop-saturate: ;--un-backdrop-sepia: ;
}
::backdrop{
  --un-rotate:0;--un-rotate-x:0;--un-rotate-y:0;--un-rotate-z:0;--un-scale-x:1;--un-scale-y:1;--un-scale-z:1;--un-skew-x:0;--un-skew-y:0;--un-translate-x:0;--un-translate-y:0;--un-translate-z:0;--un-pan-x: ;--un-pan-y: ;--un-pinch-zoom: ;--un-scroll-snap-strictness:proximity;--un-ordinal: ;--un-slashed-zero: ;--un-numeric-figure: ;--un-numeric-spacing: ;--un-numeric-fraction: ;--un-border-spacing-x:0;--un-border-spacing-y:0;--un-ring-offset-shadow:0 0 rgba(0,0,0,0);--un-ring-shadow:0 0 rgba(0,0,0,0);--un-shadow-inset: ;--un-shadow:0 0 rgba(0,0,0,0);--un-ring-inset: ;--un-ring-offset-width:0px;--un-ring-offset-color:#fff;--un-ring-width:0px;--un-ring-color:rgba(147,197,253,0.5);--un-blur: ;--un-brightness: ;--un-contrast: ;--un-drop-shadow: ;--un-grayscale: ;--un-hue-rotate: ;--un-invert: ;--un-saturate: ;--un-sepia: ;--un-backdrop-blur: ;--un-backdrop-brightness: ;--un-backdrop-contrast: ;--un-backdrop-grayscale: ;--un-backdrop-hue-rotate: ;--un-backdrop-invert: ;--un-backdrop-opacity: ;--un-backdrop-saturate: ;--un-backdrop-sepia: ;
}
/* layer: default */
[absolute=""]{position:absolute;}
[relative=""]{position:relative;}
.static{position:static;}
[bottom~="\\30 "]{bottom:0;}
[right~="\\30 "]{right:0;}
.z-10{z-index:10;}
[hover~="z-10"]:hover{z-index:10;}
[mx-auto=""]{margin-left:auto;margin-right:auto;}
[my-4=""]{margin-top:1rem;margin-bottom:1rem;}
[mb-4=""]{margin-bottom:1rem;}
[mb-auto=""]{margin-bottom:auto;}
[ml-auto=""]{margin-left:auto;}
[mr-2=""]{margin-right:0.5rem;}
[hidden=""]{display:none;}
[h-12=""]{height:3rem;}
[w-12=""]{width:3rem;}
[flex=""],
[flex~="\\~"]{display:flex;}
[shrink~="\\30 "]{flex-shrink:0;}
[flex~="row-reverse"]{flex-direction:row-reverse;}
[flex~="col"]{flex-direction:column;}
[flex~="wrap"]{flex-wrap:wrap;}
[items-center=""]{align-items:center;}
[justify~="end"]{justify-content:flex-end;}
[gap~="\\32 "]{gap:0.5rem;}
[gap~="\\33 "]{gap:0.75rem;}
[gap~="y-2"]{row-gap:0.5rem;}
[space-x~="-\\32 "]>:not([hidden])~:not([hidden]){--un-space-x-reverse:0;margin-left:calc(-0.5rem * calc(1 - var(--un-space-x-reverse)));margin-right:calc(-0.5rem * var(--un-space-x-reverse));}
[space-x~="reverse"]>:not([hidden])~:not([hidden]){--un-space-x-reverse:1;}
[break-all=""]{word-break:break-all;}
[rounded~="avatar"]{border-radius:var(--seia-rounded-avatar, 8964px);}
[rounded~="card"]{border-radius:var(--seia-rounded-card, 0.75rem);}
[bg~="seia-bg"]{background-color:var(--seia-color-bg, #f8fafc);}
[p-4=""]{padding:1rem;}
[text~="sm"]{font-size:0.875rem;line-height:1.25rem;}
[font~="bold"]{font-weight:700;}
.text-seia-primary,
[text~="seia-primary"]{color:var(--seia-color-primary, #ea580c);}
[text~="seia-text"]{color:var(--seia-color-text, #0f172a);}
[hover~="text-seia-primary"]:hover{color:var(--seia-color-primary, #ea580c);}
.underline{text-decoration-line:underline;}
[hover~="underline"]:hover{text-decoration-line:underline;}
[opacity-75=""]{opacity:0.75;}
[ring~="\\32 "]{--un-ring-width:2px;--un-ring-offset-shadow:var(--un-ring-inset) 0 0 0 var(--un-ring-offset-width) var(--un-ring-offset-color);--un-ring-shadow:var(--un-ring-inset) 0 0 0 calc(var(--un-ring-width) + var(--un-ring-offset-width)) var(--un-ring-color);box-shadow:var(--un-ring-offset-shadow), var(--un-ring-shadow), var(--un-shadow);}
[ring~="seia-bg"]{--un-ring-color:var(--seia-color-bg, #f8fafc);}
.group:hover [ring~="group-hover\\:seia-primary"]{--un-ring-color:var(--seia-color-primary, #ea580c);}
[transition=""]{transition-property:color,background-color,border-color,outline-color,text-decoration-color,fill,stroke,opacity,box-shadow,transform,filter,backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms;}`), Z);
y([
  $({ type: String })
], f.prototype, "api", void 0);
y([
  $({ type: String })
], f.prototype, "css", void 0);
y([
  $({ type: Boolean })
], f.prototype, "powered-by", void 0);
y([
  $({ type: Boolean })
], f.prototype, "unsafe-html", void 0);
y([
  $({ type: String })
], f.prototype, "sort-by", void 0);
y([
  $({ type: String })
], f.prototype, "sort-dir", void 0);
y([
  $({ type: Number })
], f.prototype, "per-page", void 0);
y([
  $({ type: String })
], f.prototype, "target", void 0);
y([
  $({ type: String })
], f.prototype, "fallback-photo", void 0);
f = y([
  zt("s-e-i-a")
], f);
export {
  f as Seia
};
