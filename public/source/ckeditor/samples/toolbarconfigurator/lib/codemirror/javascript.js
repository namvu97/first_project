﻿(function (p) {
    "object" == typeof exports && "object" == typeof module ? p(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], p) : p(CodeMirror)
})(function (p) {
    p.defineMode("javascript", function (oa, t) {
        function q(a, c, e) {
            E = a;
            I = e;
            return c
        }
        function w(a, c) {
            var e = a.next();
            if ('"' == e || "'" == e)
                return c.tokenize = pa(e), c.tokenize(a, c);
            if ("." == e && a.match(/^\d+(?:[eE][+\-]?\d+)?/))
                return q("number", "number");
            if ("." == e && a.match(".."))
                return q("spread", "meta");
            if (/[\[\]{}\(\),;\:\.]/.test(e))
                return q(e);
            if ("\x3d" == e && a.eat("\x3e"))
                return q("\x3d\x3e", "operator");
            if ("0" == e && a.eat(/x/i))
                return a.eatWhile(/[\da-f]/i), q("number", "number");
            if (/\d/.test(e))
                return a.match(/^\d*(?:\.\d*)?(?:[eE][+\-]?\d+)?/), q("number", "number");
            if ("/" == e) {
                if (a.eat("*"))
                    return c.tokenize = J, J(a, c);
                if (a.eat("/"))
                    return a.skipToEnd(), q("comment", "comment");
                if ("operator" == c.lastType || "keyword c" == c.lastType || "sof" == c.lastType || /^[\[{}\(,;:]$/.test(c.lastType)) {
                    a:for (var e = !1, d, b = !1; null != (d = a.next()); ) {
                        if (!e) {
                            if ("/" == d && !b)
                                break a;
                            "[" == d ? b = !0 : b && "]" == d && (b = !1)
                        }
                        e = !e && "\\" == d
                    }
                    a.match(/^\b(([gimyu])(?![gimyu]*\2))+\b/);
                    return q("regexp", "string-2")
                }
                a.eatWhile(K);
                return q("operator", "operator", a.current())
            }
            if ("`" == e)
                return c.tokenize = Q, Q(a, c);
            if ("#" == e)
                return a.skipToEnd(), q("error", "error");
            if (K.test(e))
                return a.eatWhile(K), q("operator", "operator", a.current());
            if (R.test(e))
                return a.eatWhile(R), e = a.current(), (d = ba.propertyIsEnumerable(e) && ba[e]) && "." != c.lastType ? q(d.type, d.style, e) : q("variable", "variable", e)
        }
        function pa(a) {
            return function (c,
                    e) {
                var d = !1, b;
                if (L && "@" == c.peek() && c.match(qa))
                    return e.tokenize = w, q("jsonld-keyword", "meta");
                for (; null != (b = c.next()) && (b != a || d); )
                    d = !d && "\\" == b;
                d || (e.tokenize = w);
                return q("string", "string")
            }
        }
        function J(a, c) {
            for (var e = !1, d; d = a.next(); ) {
                if ("/" == d && e) {
                    c.tokenize = w;
                    break
                }
                e = "*" == d
            }
            return q("comment", "comment")
        }
        function Q(a, c) {
            for (var e = !1, d; null != (d = a.next()); ) {
                if (!e && ("`" == d || "$" == d && a.eat("{"))) {
                    c.tokenize = w;
                    break
                }
                e = !e && "\\" == d
            }
            return q("quasi", "string-2", a.current())
        }
        function S(a, c) {
            c.fatArrowAt && (c.fatArrowAt =
                    null);
            var e = a.string.indexOf("\x3d\x3e", a.start);
            if (!(0 > e)) {
                for (var d = 0, b = !1, e = e - 1; 0 <= e; --e) {
                    var f = a.string.charAt(e), g = "([{}])".indexOf(f);
                    if (0 <= g && 3 > g) {
                        if (!d) {
                            ++e;
                            break
                        }
                        if (0 == --d)
                            break
                    } else if (3 <= g && 6 > g)
                        ++d;
                    else if (R.test(f))
                        b = !0;
                    else {
                        if (/["'\/]/.test(f))
                            return;
                        if (b && !d) {
                            ++e;
                            break
                        }
                    }
                }
                b && !d && (c.fatArrowAt = e)
            }
        }
        function ca(a, c, b, d, f, h) {
            this.indented = a;
            this.column = c;
            this.type = b;
            this.prev = f;
            this.info = h;
            null != d && (this.align = d)
        }
        function g() {
            for (var a = arguments.length - 1; 0 <= a; a--)
                f.cc.push(arguments[a])
        }
        function b() {
            g.apply(null, arguments);
            return!0
        }
        function x(a) {
            function c(c) {
                for (; c; c = c.next)
                    if (c.name == a)
                        return!0;
                return!1
            }
            var b = f.state;
            b.context ? (f.marked = "def", c(b.localVars) || (b.localVars = {name: a, next: b.localVars})) : !c(b.globalVars) && t.globalVars && (b.globalVars = {name: a, next: b.globalVars})
        }
        function y() {
            f.state.context = {prev: f.state.context, vars: f.state.localVars};
            f.state.localVars = ra
        }
        function z() {
            f.state.localVars = f.state.context.vars;
            f.state.context = f.state.context.prev
        }
        function l(a, c) {
            var b = function () {
                var b =
                        f.state, e = b.indented;
                if ("stat" == b.lexical.type)
                    e = b.lexical.indented;
                else
                    for (var h = b.lexical; h && ")" == h.type && h.align; h = h.prev)
                        e = h.indented;
                b.lexical = new ca(e, f.stream.column(), a, null, b.lexical, c)
            };
            b.lex = !0;
            return b
        }
        function k() {
            var a = f.state;
            a.lexical.prev && (")" == a.lexical.type && (a.indented = a.lexical.indented), a.lexical = a.lexical.prev)
        }
        function m(a) {
            function c(e) {
                return e == a ? b() : ";" == a ? g() : b(c)
            }
            return c
        }
        function r(a, c) {
            return"var" == a ? b(l("vardef", c.length), T, m(";"), k) : "keyword a" == a ? b(l("form"), n,
                    r, k) : "keyword b" == a ? b(l("form"), r, k) : "{" == a ? b(l("}"), U, k) : ";" == a ? b() : "if" == a ? ("else" == f.state.lexical.info && f.state.cc[f.state.cc.length - 1] == k && f.state.cc.pop()(), b(l("form"), n, r, k, da)) : "function" == a ? b(v) : "for" == a ? b(l("form"), ea, r, k) : "variable" == a ? b(l("stat"), sa) : "switch" == a ? b(l("form"), n, l("}", "switch"), m("{"), U, k, k) : "case" == a ? b(n, m(":")) : "default" == a ? b(m(":")) : "catch" == a ? b(l("form"), y, m("("), V, m(")"), r, k, z) : "module" == a ? b(l("form"), y, ta, z, k) : "class" == a ? b(l("form"), ua, k) : "export" == a ? b(l("form"), va,
                    k) : "import" == a ? b(l("form"), wa, k) : g(l("stat"), n, m(";"), k)
        }
        function n(a) {
            return fa(a, !1)
        }
        function u(a) {
            return fa(a, !0)
        }
        function fa(a, c) {
            if (f.state.fatArrowAt == f.stream.start) {
                var e = c ? ga : ha;
                if ("(" == a)
                    return b(y, l(")"), F(A, ")"), k, m("\x3d\x3e"), e, z);
                if ("variable" == a)
                    return g(y, A, m("\x3d\x3e"), e, z)
            }
            e = c ? W : M;
            return xa.hasOwnProperty(a) ? b(e) : "function" == a ? b(v, e) : "keyword c" == a ? b(c ? ia : X) : "(" == a ? b(l(")"), X, N, m(")"), k, e) : "operator" == a || "spread" == a ? b(c ? u : n) : "[" == a ? b(l("]"), ya, k, e) : "{" == a ? G(za, "}", null, e) : "quasi" ==
                    a ? g(O, e) : b()
        }
        function X(a) {
            return a.match(/[;\}\)\],]/) ? g() : g(n)
        }
        function ia(a) {
            return a.match(/[;\}\)\],]/) ? g() : g(u)
        }
        function M(a, c) {
            return"," == a ? b(n) : W(a, c, !1)
        }
        function W(a, c, e) {
            var d = 0 == e ? M : W, f = 0 == e ? n : u;
            if ("\x3d\x3e" == a)
                return b(y, e ? ga : ha, z);
            if ("operator" == a)
                return/\+\+|--/.test(c) ? b(d) : "?" == c ? b(n, m(":"), f) : b(f);
            if ("quasi" == a)
                return g(O, d);
            if (";" != a) {
                if ("(" == a)
                    return G(u, ")", "call", d);
                if ("." == a)
                    return b(Aa, d);
                if ("[" == a)
                    return b(l("]"), X, m("]"), k, d)
            }
        }
        function O(a, c) {
            return"quasi" != a ? g() : "${" != c.slice(c.length -
                    2) ? b(O) : b(n, Ba)
        }
        function Ba(a) {
            if ("}" == a)
                return f.marked = "string-2", f.state.tokenize = Q, b(O)
        }
        function ha(a) {
            S(f.stream, f.state);
            return g("{" == a ? r : n)
        }
        function ga(a) {
            S(f.stream, f.state);
            return g("{" == a ? r : u)
        }
        function sa(a) {
            return":" == a ? b(k, r) : g(M, m(";"), k)
        }
        function Aa(a) {
            if ("variable" == a)
                return f.marked = "property", b()
        }
        function za(a, c) {
            if ("variable" == a || "keyword" == f.style)
                return f.marked = "property", "get" == c || "set" == c ? b(Ca) : b(H);
            if ("number" == a || "string" == a)
                return f.marked = L ? "property" : f.style + " property",
                        b(H);
            if ("jsonld-keyword" == a)
                return b(H);
            if ("[" == a)
                return b(n, m("]"), H)
        }
        function Ca(a) {
            if ("variable" != a)
                return g(H);
            f.marked = "property";
            return b(v)
        }
        function H(a) {
            if (":" == a)
                return b(u);
            if ("(" == a)
                return g(v)
        }
        function F(a, c) {
            function e(d) {
                return"," == d ? (d = f.state.lexical, "call" == d.info && (d.pos = (d.pos || 0) + 1), b(a, e)) : d == c ? b() : b(m(c))
            }
            return function (d) {
                return d == c ? b() : g(a, e)
            }
        }
        function G(a, c, e) {
            for (var d = 3; d < arguments.length; d++)
                f.cc.push(arguments[d]);
            return b(l(c, e), F(a, c), k)
        }
        function U(a) {
            return"}" == a ?
                    b() : g(r, U)
        }
        function ja(a) {
            if (ka && ":" == a)
                return b(Da)
        }
        function Da(a) {
            if ("variable" == a)
                return f.marked = "variable-3", b()
        }
        function T() {
            return g(A, ja, Y, Ea)
        }
        function A(a, c) {
            if ("variable" == a)
                return x(c), b();
            if ("[" == a)
                return G(A, "]");
            if ("{" == a)
                return G(Fa, "}")
        }
        function Fa(a, c) {
            if ("variable" == a && !f.stream.match(/^\s*:/, !1))
                return x(c), b(Y);
            "variable" == a && (f.marked = "property");
            return b(m(":"), A, Y)
        }
        function Y(a, c) {
            if ("\x3d" == c)
                return b(u)
        }
        function Ea(a) {
            if ("," == a)
                return b(T)
        }
        function da(a, c) {
            if ("keyword b" ==
                    a && "else" == c)
                return b(l("form", "else"), r, k)
        }
        function ea(a) {
            if ("(" == a)
                return b(l(")"), Ga, m(")"), k)
        }
        function Ga(a) {
            return"var" == a ? b(T, m(";"), P) : ";" == a ? b(P) : "variable" == a ? b(Ha) : g(n, m(";"), P)
        }
        function Ha(a, c) {
            return"in" == c || "of" == c ? (f.marked = "keyword", b(n)) : b(M, P)
        }
        function P(a, c) {
            return";" == a ? b(la) : "in" == c || "of" == c ? (f.marked = "keyword", b(n)) : g(n, m(";"), la)
        }
        function la(a) {
            ")" != a && b(n)
        }
        function v(a, c) {
            if ("*" == c)
                return f.marked = "keyword", b(v);
            if ("variable" == a)
                return x(c), b(v);
            if ("(" == a)
                return b(y, l(")"),
                        F(V, ")"), k, r, z)
        }
        function V(a) {
            return"spread" == a ? b(V) : g(A, ja)
        }
        function ua(a, c) {
            if ("variable" == a)
                return x(c), b(ma)
        }
        function ma(a, c) {
            if ("extends" == c)
                return b(n, ma);
            if ("{" == a)
                return b(l("}"), B, k)
        }
        function B(a, c) {
            if ("variable" == a || "keyword" == f.style) {
                if ("static" == c)
                    return f.marked = "keyword", b(B);
                f.marked = "property";
                return"get" == c || "set" == c ? b(Ia, v, B) : b(v, B)
            }
            if ("*" == c)
                return f.marked = "keyword", b(B);
            if (";" == a)
                return b(B);
            if ("}" == a)
                return b()
        }
        function Ia(a) {
            if ("variable" != a)
                return g();
            f.marked = "property";
            return b()
        }
        function ta(a, c) {
            if ("string" == a)
                return b(r);
            if ("variable" == a)
                return x(c), b(Z)
        }
        function va(a, c) {
            return"*" == c ? (f.marked = "keyword", b(Z, m(";"))) : "default" == c ? (f.marked = "keyword", b(n, m(";"))) : g(r)
        }
        function wa(a) {
            return"string" == a ? b() : g(aa, Z)
        }
        function aa(a, c) {
            if ("{" == a)
                return G(aa, "}");
            "variable" == a && x(c);
            "*" == c && (f.marked = "keyword");
            return b(Ja)
        }
        function Ja(a, c) {
            if ("as" == c)
                return f.marked = "keyword", b(aa)
        }
        function Z(a, c) {
            if ("from" == c)
                return f.marked = "keyword", b(n)
        }
        function ya(a) {
            return"]" == a ?
                    b() : g(u, Ka)
        }
        function Ka(a) {
            return"for" == a ? g(N, m("]")) : "," == a ? b(F(ia, "]")) : g(F(u, "]"))
        }
        function N(a) {
            if ("for" == a)
                return b(ea, N);
            if ("if" == a)
                return b(n, N)
        }
        var C = oa.indentUnit, na = t.statementIndent, L = t.jsonld, D = t.json || L, ka = t.typescript, R = t.wordCharacters || /[\w$\xa1-\uffff]/, ba = function () {
            function a(a) {
                return{type: a, style: "keyword"}
            }
            var c = a("keyword a"), b = a("keyword b"), d = a("keyword c"), f = a("operator"), h = {type: "atom", style: "atom"}, c = {"if": a("if"), "while": c, "with": c, "else": b, "do": b, "try": b, "finally": b,
                "return": d, "break": d, "continue": d, "new": d, "delete": d, "throw": d, "debugger": d, "var": a("var"), "const": a("var"), let: a("var"), "function": a("function"), "catch": a("catch"), "for": a("for"), "switch": a("switch"), "case": a("case"), "default": a("default"), "in": f, "typeof": f, "instanceof": f, "true": h, "false": h, "null": h, undefined: h, NaN: h, Infinity: h, "this": a("this"), module: a("module"), "class": a("class"), "super": a("atom"), yield: d, "export": a("export"), "import": a("import"), "extends": d};
            if (ka) {
                var b = {type: "variable", style: "variable-3"},
                b = {"interface": a("interface"), "extends": a("extends"), constructor: a("constructor"), "public": a("public"), "private": a("private"), "protected": a("protected"), "static": a("static"), string: b, number: b, bool: b, any: b}, g;
                for (g in b)
                    c[g] = b[g]
            }
            return c
        }(), K = /[+\-*&%=<>!?|~^]/, qa = /^@(context|id|value|language|type|container|list|set|reverse|index|base|vocab|graph)"/, E, I, xa = {atom: !0, number: !0, variable: !0, string: !0, regexp: !0, "this": !0, "jsonld-keyword": !0}, f = {state: null, column: null, marked: null, cc: null}, ra = {name: "this",
            next: {name: "arguments"}};
        k.lex = !0;
        return{startState: function (a) {
                a = {tokenize: w, lastType: "sof", cc: [], lexical: new ca((a || 0) - C, 0, "block", !1), localVars: t.localVars, context: t.localVars && {vars: t.localVars}, indented: 0};
                t.globalVars && "object" == typeof t.globalVars && (a.globalVars = t.globalVars);
                return a
            }, token: function (a, b) {
                a.sol() && (b.lexical.hasOwnProperty("align") || (b.lexical.align = !1), b.indented = a.indentation(), S(a, b));
                if (b.tokenize != J && a.eatSpace())
                    return null;
                var e = b.tokenize(a, b);
                if ("comment" == E)
                    return e;
                b.lastType = "operator" != E || "++" != I && "--" != I ? E : "incdec";
                a:{
                    var d = E, g = I, h = b.cc;
                    f.state = b;
                    f.stream = a;
                    f.marked = null;
                    f.cc = h;
                    f.style = e;
                    b.lexical.hasOwnProperty("align") || (b.lexical.align = !0);
                    for (; ; )
                        if ((h.length ? h.pop() : D ? n : r)(d, g)) {
                            for (; h.length && h[h.length - 1].lex; )
                                h.pop()();
                            if (f.marked) {
                                e = f.marked;
                                break a
                            }
                            if (d = "variable" == d)
                                b:{
                                    for (d = b.localVars; d; d = d.next)
                                        if (d.name == g) {
                                            d = !0;
                                            break b
                                        }
                                    for (h = b.context; h; h = h.prev)
                                        for (d = h.vars; d; d = d.next)
                                            if (d.name == g) {
                                                d = !0;
                                                break b
                                            }
                                    d = void 0
                                }
                            if (d) {
                                e = "variable-2";
                                break a
                            }
                            break a
                        }
                }
                return e
            },
            indent: function (a, b) {
                if (a.tokenize == J)
                    return p.Pass;
                if (a.tokenize != w)
                    return 0;
                var e = b && b.charAt(0), d = a.lexical;
                if (!/^\s*else\b/.test(b))
                    for (var f = a.cc.length - 1; 0 <= f; --f) {
                        var g = a.cc[f];
                        if (g == k)
                            d = d.prev;
                        else if (g != da)
                            break
                    }
                "stat" == d.type && "}" == e && (d = d.prev);
                na && ")" == d.type && "stat" == d.prev.type && (d = d.prev);
                f = d.type;
                g = e == f;
                return"vardef" == f ? d.indented + ("operator" == a.lastType || "," == a.lastType ? d.info + 1 : 0) : "form" == f && "{" == e ? d.indented : "form" == f ? d.indented + C : "stat" == f ? (e = d.indented, d = "operator" == a.lastType ||
                        "," == a.lastType || K.test(b.charAt(0)) || /[,.]/.test(b.charAt(0)), e + (d ? na || C : 0)) : "switch" != d.info || g || 0 == t.doubleIndentSwitch ? d.align ? d.column + (g ? 0 : 1) : d.indented + (g ? 0 : C) : d.indented + (/^(?:case|default)\b/.test(b) ? C : 2 * C)
            }, electricInput: /^\s*(?:case .*?:|default:|\{|\})$/, blockCommentStart: D ? null : "/*", blockCommentEnd: D ? null : "*/", lineComment: D ? null : "//", fold: "brace", closeBrackets: "()[]{}''\"\"``", helperType: D ? "json" : "javascript", jsonldMode: L, jsonMode: D}
    });
    p.registerHelper("wordChars", "javascript", /[\w$]/);
    p.defineMIME("text/javascript", "javascript");
    p.defineMIME("text/ecmascript", "javascript");
    p.defineMIME("application/javascript", "javascript");
    p.defineMIME("application/x-javascript", "javascript");
    p.defineMIME("application/ecmascript", "javascript");
    p.defineMIME("application/json", {name: "javascript", json: !0});
    p.defineMIME("application/x-json", {name: "javascript", json: !0});
    p.defineMIME("application/ld+json", {name: "javascript", jsonld: !0});
    p.defineMIME("text/typescript", {name: "javascript", typescript: !0});
    p.defineMIME("application/typescript", {name: "javascript", typescript: !0})
});