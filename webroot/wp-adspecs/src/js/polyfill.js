/*! (C) Andrea Giammarchi - Mit Style License */
var URLSearchParams = URLSearchParams || function() { "use strict";

    function URLSearchParams(query) { var index, key, value, pairs, i, length, dict = Object.create(null);
        this[secret] = dict; if (!query) return; if (typeof query === "string") { if (query.charAt(0) === "?") { query = query.slice(1) } for (pairs = query.split("&"), i = 0, length = pairs.length; i < length; i++) { value = pairs[i];
                index = value.indexOf("="); if (-1 < index) { appendTo(dict, decode(value.slice(0, index)), decode(value.slice(index + 1))) } else if (value.length) { appendTo(dict, decode(value), "") } } } else { if (isArray(query)) { for (i = 0, length = query.length; i < length; i++) { value = query[i];
                    appendTo(dict, value[0], value[1]) } } else { for (key in query) { appendTo(dict, key, query[key]) } } } } var isArray = Array.isArray,
        URLSearchParamsProto = URLSearchParams.prototype,
        find = /[!'\(\)~]|%20|%00/g,
        plus = /\+/g,
        replace = { "!": "%21", "'": "%27", "(": "%28", ")": "%29", "~": "%7E", "%20": "+", "%00": "\0" },
        replacer = function(match) { return replace[match] },
        secret = "__URLSearchParams__:" + Math.random();

    function appendTo(dict, name, value) { if (name in dict) { dict[name].push("" + value) } else { dict[name] = isArray(value) ? value : ["" + value] } }

    function decode(str) { return decodeURIComponent(str.replace(plus, " ")) }

    function encode(str) { return encodeURIComponent(str).replace(find, replacer) } URLSearchParamsProto.append = function append(name, value) { appendTo(this[secret], name, value) };
    URLSearchParamsProto["delete"] = function del(name) { delete this[secret][name] };
    URLSearchParamsProto.get = function get(name) { var dict = this[secret]; return name in dict ? dict[name][0] : null };
    URLSearchParamsProto.getAll = function getAll(name) { var dict = this[secret]; return name in dict ? dict[name].slice(0) : [] };
    URLSearchParamsProto.has = function has(name) { return name in this[secret] };
    URLSearchParamsProto.set = function set(name, value) { this[secret][name] = ["" + value] };
    URLSearchParamsProto.forEach = function forEach(callback, thisArg) { var dict = this[secret];
        Object.getOwnPropertyNames(dict).forEach(function(name) { dict[name].forEach(function(value) { callback.call(thisArg, value, name, this) }, this) }, this) };
    URLSearchParamsProto.toJSON = function toJSON() { return {} };
    URLSearchParamsProto.toString = function toString() { var dict = this[secret],
            query = [],
            i, key, name, value; for (key in dict) { name = encode(key); for (i = 0, value = dict[key]; i < value.length; i++) { query.push(name + "=" + encode(value[i])) } } return query.join("&") }; var dP = Object.defineProperty,
        gOPD = Object.getOwnPropertyDescriptor,
        createSearchParamsPollute = function(search) {
            function append(name, value) { URLSearchParamsProto.append.call(this, name, value);
                name = this.toString();
                search.set.call(this._usp, name ? "?" + name : "") }

            function del(name) { URLSearchParamsProto["delete"].call(this, name);
                name = this.toString();
                search.set.call(this._usp, name ? "?" + name : "") }

            function set(name, value) { URLSearchParamsProto.set.call(this, name, value);
                name = this.toString();
                search.set.call(this._usp, name ? "?" + name : "") } return function(sp, value) { sp.append = append;
                sp["delete"] = del;
                sp.set = set; return dP(sp, "_usp", { configurable: true, writable: true, value: value }) } },
        createSearchParamsCreate = function(polluteSearchParams) { return function(obj, sp) { dP(obj, "_searchParams", { configurable: true, writable: true, value: polluteSearchParams(sp, obj) }); return sp } },
        updateSearchParams = function(sp) { var append = sp.append;
            sp.append = URLSearchParamsProto.append;
            URLSearchParams.call(sp, sp._usp.search.slice(1));
            sp.append = append },
        verifySearchParams = function(obj, Class) { if (!(obj instanceof Class)) throw new TypeError("'searchParams' accessed on an object that " + "does not implement interface " + Class.name) },
        upgradeClass = function(Class) { var ClassProto = Class.prototype,
                searchParams = gOPD(ClassProto, "searchParams"),
                href = gOPD(ClassProto, "href"),
                search = gOPD(ClassProto, "search"),
                createSearchParams; if (!searchParams && search && search.set) { createSearchParams = createSearchParamsCreate(createSearchParamsPollute(search));
                Object.defineProperties(ClassProto, { href: { get: function() { return href.get.call(this) }, set: function(value) { var sp = this._searchParams;
                            href.set.call(this, value); if (sp) updateSearchParams(sp) } }, search: { get: function() { return search.get.call(this) }, set: function(value) { var sp = this._searchParams;
                            search.set.call(this, value); if (sp) updateSearchParams(sp) } }, searchParams: { get: function() { verifySearchParams(this, Class); return this._searchParams || createSearchParams(this, new URLSearchParams(this.search.slice(1))) }, set: function(sp) { verifySearchParams(this, Class);
                            createSearchParams(this, sp) } } }) } };
    upgradeClass(HTMLAnchorElement); if (/^function|object$/.test(typeof URL) && URL.prototype) upgradeClass(URL); return URLSearchParams }();
(function(URLSearchParamsProto) { var iterable = function() { try { return !!Symbol.iterator } catch (error) { return false } }(); if (!("forEach" in URLSearchParamsProto)) { URLSearchParamsProto.forEach = function forEach(callback, thisArg) { var names = Object.create(null);
            this.toString().replace(/=[\s\S]*?(?:&|$)/g, "=").split("=").forEach(function(name) { if (!name.length || name in names) return;
                (names[name] = this.getAll(name)).forEach(function(value) { callback.call(thisArg, value, name, this) }, this) }, this) } } if (!("keys" in URLSearchParamsProto)) { URLSearchParamsProto.keys = function keys() { var items = [];
            this.forEach(function(value, name) { items.push(name) }); var iterator = { next: function() { var value = items.shift(); return { done: value === undefined, value: value } } }; if (iterable) { iterator[Symbol.iterator] = function() { return iterator } } return iterator } } if (!("values" in URLSearchParamsProto)) { URLSearchParamsProto.values = function values() { var items = [];
            this.forEach(function(value) { items.push(value) }); var iterator = { next: function() { var value = items.shift(); return { done: value === undefined, value: value } } }; if (iterable) { iterator[Symbol.iterator] = function() { return iterator } } return iterator } } if (!("entries" in URLSearchParamsProto)) { URLSearchParamsProto.entries = function entries() { var items = [];
            this.forEach(function(value, name) { items.push([name, value]) }); var iterator = { next: function() { var value = items.shift(); return { done: value === undefined, value: value } } }; if (iterable) { iterator[Symbol.iterator] = function() { return iterator } } return iterator } } if (iterable && !(Symbol.iterator in URLSearchParamsProto)) { URLSearchParamsProto[Symbol.iterator] = URLSearchParamsProto.entries } if (!("sort" in URLSearchParamsProto)) { URLSearchParamsProto.sort = function sort() { var entries = this.entries(),
                entry = entries.next(),
                done = entry.done,
                keys = [],
                values = Object.create(null),
                i, key, value; while (!done) { value = entry.value;
                key = value[0];
                keys.push(key); if (!(key in values)) { values[key] = [] } values[key].push(value[1]);
                entry = entries.next();
                done = entry.done } keys.sort(); for (i = 0; i < keys.length; i++) { this["delete"](keys[i]) } for (i = 0; i < keys.length; i++) { key = keys[i];
                this.append(key, values[key].shift()) } } } })(URLSearchParams.prototype);

(function(self) {
  'use strict';

  if (self.fetch) {
    return
  }

  var support = {
    searchParams: 'URLSearchParams' in self,
    iterable: 'Symbol' in self && 'iterator' in Symbol,
    blob: 'FileReader' in self && 'Blob' in self && (function() {
      try {
        new Blob()
        return true
      } catch(e) {
        return false
      }
    })(),
    formData: 'FormData' in self,
    arrayBuffer: 'ArrayBuffer' in self
  }

  if (support.arrayBuffer) {
    var viewClasses = [
      '[object Int8Array]',
      '[object Uint8Array]',
      '[object Uint8ClampedArray]',
      '[object Int16Array]',
      '[object Uint16Array]',
      '[object Int32Array]',
      '[object Uint32Array]',
      '[object Float32Array]',
      '[object Float64Array]'
    ]

    var isDataView = function(obj) {
      return obj && DataView.prototype.isPrototypeOf(obj)
    }

    var isArrayBufferView = ArrayBuffer.isView || function(obj) {
      return obj && viewClasses.indexOf(Object.prototype.toString.call(obj)) > -1
    }
  }

  function normalizeName(name) {
    if (typeof name !== 'string') {
      name = String(name)
    }
    if (/[^a-z0-9\-#$%&'*+.\^_`|~]/i.test(name)) {
      throw new TypeError('Invalid character in header field name')
    }
    return name.toLowerCase()
  }

  function normalizeValue(value) {
    if (typeof value !== 'string') {
      value = String(value)
    }
    return value
  }

  // Build a destructive iterator for the value list
  function iteratorFor(items) {
    var iterator = {
      next: function() {
        var value = items.shift()
        return {done: value === undefined, value: value}
      }
    }

    if (support.iterable) {
      iterator[Symbol.iterator] = function() {
        return iterator
      }
    }

    return iterator
  }

  function Headers(headers) {
    this.map = {}

    if (headers instanceof Headers) {
      headers.forEach(function(value, name) {
        this.append(name, value)
      }, this)
    } else if (Array.isArray(headers)) {
      headers.forEach(function(header) {
        this.append(header[0], header[1])
      }, this)
    } else if (headers) {
      Object.getOwnPropertyNames(headers).forEach(function(name) {
        this.append(name, headers[name])
      }, this)
    }
  }

  Headers.prototype.append = function(name, value) {
    name = normalizeName(name)
    value = normalizeValue(value)
    var oldValue = this.map[name]
    this.map[name] = oldValue ? oldValue+','+value : value
  }

  Headers.prototype['delete'] = function(name) {
    delete this.map[normalizeName(name)]
  }

  Headers.prototype.get = function(name) {
    name = normalizeName(name)
    return this.has(name) ? this.map[name] : null
  }

  Headers.prototype.has = function(name) {
    return this.map.hasOwnProperty(normalizeName(name))
  }

  Headers.prototype.set = function(name, value) {
    this.map[normalizeName(name)] = normalizeValue(value)
  }

  Headers.prototype.forEach = function(callback, thisArg) {
    for (var name in this.map) {
      if (this.map.hasOwnProperty(name)) {
        callback.call(thisArg, this.map[name], name, this)
      }
    }
  }

  Headers.prototype.keys = function() {
    var items = []
    this.forEach(function(value, name) { items.push(name) })
    return iteratorFor(items)
  }

  Headers.prototype.values = function() {
    var items = []
    this.forEach(function(value) { items.push(value) })
    return iteratorFor(items)
  }

  Headers.prototype.entries = function() {
    var items = []
    this.forEach(function(value, name) { items.push([name, value]) })
    return iteratorFor(items)
  }

  if (support.iterable) {
    Headers.prototype[Symbol.iterator] = Headers.prototype.entries
  }

  function consumed(body) {
    if (body.bodyUsed) {
      return Promise.reject(new TypeError('Already read'))
    }
    body.bodyUsed = true
  }

  function fileReaderReady(reader) {
    return new Promise(function(resolve, reject) {
      reader.onload = function() {
        resolve(reader.result)
      }
      reader.onerror = function() {
        reject(reader.error)
      }
    })
  }

  function readBlobAsArrayBuffer(blob) {
    var reader = new FileReader()
    var promise = fileReaderReady(reader)
    reader.readAsArrayBuffer(blob)
    return promise
  }

  function readBlobAsText(blob) {
    var reader = new FileReader()
    var promise = fileReaderReady(reader)
    reader.readAsText(blob)
    return promise
  }

  function readArrayBufferAsText(buf) {
    var view = new Uint8Array(buf)
    var chars = new Array(view.length)

    for (var i = 0; i < view.length; i++) {
      chars[i] = String.fromCharCode(view[i])
    }
    return chars.join('')
  }

  function bufferClone(buf) {
    if (buf.slice) {
      return buf.slice(0)
    } else {
      var view = new Uint8Array(buf.byteLength)
      view.set(new Uint8Array(buf))
      return view.buffer
    }
  }

  function Body() {
    this.bodyUsed = false

    this._initBody = function(body) {
      this._bodyInit = body
      if (!body) {
        this._bodyText = ''
      } else if (typeof body === 'string') {
        this._bodyText = body
      } else if (support.blob && Blob.prototype.isPrototypeOf(body)) {
        this._bodyBlob = body
      } else if (support.formData && FormData.prototype.isPrototypeOf(body)) {
        this._bodyFormData = body
      } else if (support.searchParams && URLSearchParams.prototype.isPrototypeOf(body)) {
        this._bodyText = body.toString()
      } else if (support.arrayBuffer && support.blob && isDataView(body)) {
        this._bodyArrayBuffer = bufferClone(body.buffer)
        // IE 10-11 can't handle a DataView body.
        this._bodyInit = new Blob([this._bodyArrayBuffer])
      } else if (support.arrayBuffer && (ArrayBuffer.prototype.isPrototypeOf(body) || isArrayBufferView(body))) {
        this._bodyArrayBuffer = bufferClone(body)
      } else {
        throw new Error('unsupported BodyInit type')
      }

      if (!this.headers.get('content-type')) {
        if (typeof body === 'string') {
          this.headers.set('content-type', 'text/plain;charset=UTF-8')
        } else if (this._bodyBlob && this._bodyBlob.type) {
          this.headers.set('content-type', this._bodyBlob.type)
        } else if (support.searchParams && URLSearchParams.prototype.isPrototypeOf(body)) {
          this.headers.set('content-type', 'application/x-www-form-urlencoded;charset=UTF-8')
        }
      }
    }

    if (support.blob) {
      this.blob = function() {
        var rejected = consumed(this)
        if (rejected) {
          return rejected
        }

        if (this._bodyBlob) {
          return Promise.resolve(this._bodyBlob)
        } else if (this._bodyArrayBuffer) {
          return Promise.resolve(new Blob([this._bodyArrayBuffer]))
        } else if (this._bodyFormData) {
          throw new Error('could not read FormData body as blob')
        } else {
          return Promise.resolve(new Blob([this._bodyText]))
        }
      }

      this.arrayBuffer = function() {
        if (this._bodyArrayBuffer) {
          return consumed(this) || Promise.resolve(this._bodyArrayBuffer)
        } else {
          return this.blob().then(readBlobAsArrayBuffer)
        }
      }
    }

    this.text = function() {
      var rejected = consumed(this)
      if (rejected) {
        return rejected
      }

      if (this._bodyBlob) {
        return readBlobAsText(this._bodyBlob)
      } else if (this._bodyArrayBuffer) {
        return Promise.resolve(readArrayBufferAsText(this._bodyArrayBuffer))
      } else if (this._bodyFormData) {
        throw new Error('could not read FormData body as text')
      } else {
        return Promise.resolve(this._bodyText)
      }
    }

    if (support.formData) {
      this.formData = function() {
        return this.text().then(decode)
      }
    }

    this.json = function() {
      return this.text().then(JSON.parse)
    }

    return this
  }

  // HTTP methods whose capitalization should be normalized
  var methods = ['DELETE', 'GET', 'HEAD', 'OPTIONS', 'POST', 'PUT']

  function normalizeMethod(method) {
    var upcased = method.toUpperCase()
    return (methods.indexOf(upcased) > -1) ? upcased : method
  }

  function Request(input, options) {
    options = options || {}
    var body = options.body

    if (input instanceof Request) {
      if (input.bodyUsed) {
        throw new TypeError('Already read')
      }
      this.url = input.url
      this.credentials = input.credentials
      if (!options.headers) {
        this.headers = new Headers(input.headers)
      }
      this.method = input.method
      this.mode = input.mode
      if (!body && input._bodyInit != null) {
        body = input._bodyInit
        input.bodyUsed = true
      }
    } else {
      this.url = String(input)
    }

    this.credentials = options.credentials || this.credentials || 'omit'
    if (options.headers || !this.headers) {
      this.headers = new Headers(options.headers)
    }
    this.method = normalizeMethod(options.method || this.method || 'GET')
    this.mode = options.mode || this.mode || null
    this.referrer = null

    if ((this.method === 'GET' || this.method === 'HEAD') && body) {
      throw new TypeError('Body not allowed for GET or HEAD requests')
    }
    this._initBody(body)
  }

  Request.prototype.clone = function() {
    return new Request(this, { body: this._bodyInit })
  }

  function decode(body) {
    var form = new FormData()
    body.trim().split('&').forEach(function(bytes) {
      if (bytes) {
        var split = bytes.split('=')
        var name = split.shift().replace(/\+/g, ' ')
        var value = split.join('=').replace(/\+/g, ' ')
        form.append(decodeURIComponent(name), decodeURIComponent(value))
      }
    })
    return form
  }

  function parseHeaders(rawHeaders) {
    var headers = new Headers()
    // Replace instances of \r\n and \n followed by at least one space or horizontal tab with a space
    // https://tools.ietf.org/html/rfc7230#section-3.2
    var preProcessedHeaders = rawHeaders.replace(/\r?\n[\t ]+/g, ' ')
    preProcessedHeaders.split(/\r?\n/).forEach(function(line) {
      var parts = line.split(':')
      var key = parts.shift().trim()
      if (key) {
        var value = parts.join(':').trim()
        headers.append(key, value)
      }
    })
    return headers
  }

  Body.call(Request.prototype)

  function Response(bodyInit, options) {
    if (!options) {
      options = {}
    }

    this.type = 'default'
    this.status = options.status === undefined ? 200 : options.status
    this.ok = this.status >= 200 && this.status < 300
    this.statusText = 'statusText' in options ? options.statusText : 'OK'
    this.headers = new Headers(options.headers)
    this.url = options.url || ''
    this._initBody(bodyInit)
  }

  Body.call(Response.prototype)

  Response.prototype.clone = function() {
    return new Response(this._bodyInit, {
      status: this.status,
      statusText: this.statusText,
      headers: new Headers(this.headers),
      url: this.url
    })
  }

  Response.error = function() {
    var response = new Response(null, {status: 0, statusText: ''})
    response.type = 'error'
    return response
  }

  var redirectStatuses = [301, 302, 303, 307, 308]

  Response.redirect = function(url, status) {
    if (redirectStatuses.indexOf(status) === -1) {
      throw new RangeError('Invalid status code')
    }

    return new Response(null, {status: status, headers: {location: url}})
  }

  self.Headers = Headers
  self.Request = Request
  self.Response = Response

  self.fetch = function(input, init) {
    return new Promise(function(resolve, reject) {
      var request = new Request(input, init)
      var xhr = new XMLHttpRequest()

      xhr.onload = function() {
        var options = {
          status: xhr.status,
          statusText: xhr.statusText,
          headers: parseHeaders(xhr.getAllResponseHeaders() || '')
        }
        options.url = 'responseURL' in xhr ? xhr.responseURL : options.headers.get('X-Request-URL')
        var body = 'response' in xhr ? xhr.response : xhr.responseText
        resolve(new Response(body, options))
      }

      xhr.onerror = function() {
        reject(new TypeError('Network request failed'))
      }

      xhr.ontimeout = function() {
        reject(new TypeError('Network request failed'))
      }

      xhr.open(request.method, request.url, true)

      if (request.credentials === 'include') {
        xhr.withCredentials = true
      } else if (request.credentials === 'omit') {
        xhr.withCredentials = false
      }

      if ('responseType' in xhr && support.blob) {
        xhr.responseType = 'blob'
      }

      request.headers.forEach(function(value, name) {
        xhr.setRequestHeader(name, value)
      })

      xhr.send(typeof request._bodyInit === 'undefined' ? null : request._bodyInit)
    })
  }
  self.fetch.polyfill = true
})(typeof self !== 'undefined' ? self : this);