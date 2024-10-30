let ip, ip_value;
!(function (t) {
  "function" == typeof define && define.amd
    ? define(["jquery"], function (e) {
        t(e, window, document);
      })
    : "object" == typeof module && module.exports
    ? (module.exports = t(require("jquery"), window, document))
    : t(jQuery, window, document);
})(function (t, e, i, s) {
  "use strict";
  var n = "intlTelInput",
    o = 1,
    a = {
      allowDropdown: !0,
      autoHideDialCode: !0,
      autoPlaceholder: "polite",
      customPlaceholder: null,
      dropdownContainer: "",
      excludeCountries: [],
      formatOnDisplay: !0,
      geoIpLookup: null,
      hiddenInput: "",
      initialCountry: "",
      nationalMode: !0,
      onlyCountries: [],
      placeholderNumberType: "MOBILE",
      preferredCountries: ["us", "gb"],
      separateDialCode: !1,
      utilsScript: "",
    },
    r = 38,
    l = 40,
    u = 13,
    d = 27,
    c = 43,
    h = 65,
    p = 90,
    f = 32,
    g = 9,
    m = [
      "800",
      "822",
      "833",
      "844",
      "855",
      "866",
      "877",
      "880",
      "881",
      "882",
      "883",
      "884",
      "885",
      "886",
      "887",
      "888",
      "889",
    ];
  function y(e, i) {
    (this.telInput = t(e)),
      (this.options = t.extend({}, a, i)),
      (this.ns = "." + n + o++),
      (this.isGoodBrowser = Boolean(e.setSelectionRange)),
      (this.hadInitialPlaceholder = Boolean(t(e).attr("placeholder")));
  }
  t(e).on("load", function () {
    t.fn[n].windowLoaded = !0;
  }),
    (y.prototype = {
      _init: function () {
        return (
          this.options.nationalMode && (this.options.autoHideDialCode = !1),
          this.options.separateDialCode &&
            (this.options.autoHideDialCode = this.options.nationalMode = !1),
          (this.isMobile =
            /Android.+Mobile|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
              navigator.userAgent
            )),
          this.isMobile &&
            (t("body").addClass("iti-mobile"),
            this.options.dropdownContainer ||
              (this.options.dropdownContainer = "body")),
          (this.autoCountryDeferred = new t.Deferred()),
          (this.utilsScriptDeferred = new t.Deferred()),
          (this.selectedCountryData = {}),
          this._processCountryData(),
          this._generateMarkup(),
          this._setInitialState(),
          this._initListeners(),
          this._initRequests(),
          [this.autoCountryDeferred, this.utilsScriptDeferred]
        );
      },
      _processCountryData: function () {
        this._processAllCountries(),
          this._processCountryCodes(),
          this._processPreferredCountries();
      },
      _addCountryCode: function (t, e, i) {
        e in this.countryCodes || (this.countryCodes[e] = []);
        var s = i || 0;
        this.countryCodes[e][s] = t;
      },
      _processAllCountries: function () {
        if (this.options.onlyCountries.length) {
          var t = this.options.onlyCountries.map(function (t) {
            return t.toLowerCase();
          });
          this.countries = v.filter(function (e) {
            return t.indexOf(e.iso2) > -1;
          });
        } else if (this.options.excludeCountries.length) {
          var e = this.options.excludeCountries.map(function (t) {
            return t.toLowerCase();
          });
          this.countries = v.filter(function (t) {
            return -1 === e.indexOf(t.iso2);
          });
        } else this.countries = v;
      },
      _processCountryCodes: function () {
        this.countryCodes = {};
        for (var t = 0; t < this.countries.length; t++) {
          var e = this.countries[t];
          if (
            (this._addCountryCode(e.iso2, e.dialCode, e.priority), e.areaCodes)
          )
            for (var i = 0; i < e.areaCodes.length; i++)
              this._addCountryCode(e.iso2, e.dialCode + e.areaCodes[i]);
        }
      },
      _processPreferredCountries: function () {
        this.preferredCountries = [];
        for (var t = 0; t < this.options.preferredCountries.length; t++) {
          var e = this.options.preferredCountries[t].toLowerCase(),
            i = this._getCountryData(e, !1, !0);
          i && this.preferredCountries.push(i);
        }
      },
      _generateMarkup: function () {
        this.telInput.attr("autocomplete", "off");
        var e = "intl-tel-input";
        this.options.allowDropdown && (e += " allow-dropdown"),
          this.options.separateDialCode && (e += " separate-dial-code"),
          this.telInput.wrap(t("<div>", { class: e })),
          (this.flagsContainer = t("<div>", {
            class: "flag-container",
          }).insertBefore(this.telInput));
        var i = t("<div>", { class: "selected-flag" });
        i.appendTo(this.flagsContainer),
          (this.selectedFlagInner = t("<div>", { class: "iti-flag" }).appendTo(
            i
          )),
          this.options.separateDialCode &&
            (this.selectedDialCode = t("<div>", {
              class: "selected-dial-code",
            }).appendTo(i)),
          this.options.allowDropdown
            ? (i.attr("tabindex", "0"),
              t("<div>", { class: "iti-arrow" }).appendTo(i),
              (this.countryList = t("<ul>", { class: "country-list hide" })),
              this.preferredCountries.length &&
                (this._appendListItems(this.preferredCountries, "preferred"),
                t("<li>", { class: "divider" }).appendTo(this.countryList)),
              this._appendListItems(this.countries, ""),
              (this.countryListItems = this.countryList.children(".country")),
              this.options.dropdownContainer
                ? (this.dropdown = t("<div>", {
                    class: "intl-tel-input iti-container",
                  }).append(this.countryList))
                : this.countryList.appendTo(this.flagsContainer))
            : (this.countryListItems = t()),
          this.options.hiddenInput &&
            (this.hiddenInput = t("<input>", {
              type: "hidden",
              name: this.options.hiddenInput,
            }).insertBefore(this.telInput));
      },
      _appendListItems: function (t, e) {
        for (var i = "", s = 0; s < t.length; s++) {
          var n = t[s];
          (i +=
            "<li class='country " +
            e +
            "' data-dial-code='" +
            n.dialCode +
            "' data-country-code='" +
            n.iso2 +
            "'>"),
            (i +=
              "<div class='flag-box'><div class='iti-flag " +
              n.iso2 +
              "'></div></div>"),
            (i += "<span class='country-name'>" + n.name + "</span>"),
            (i += "<span class='dial-code'>+" + n.dialCode + "</span>"),
            (i += "</li>");
        }
        this.countryList.append(i);
      },
      _setInitialState: function () {
        var t = this.telInput.val();
        this._getDialCode(t) &&
        (!this._isRegionlessNanp(t) ||
          (this.options.nationalMode && !this.options.initialCountry))
          ? this._updateFlagFromNumber(t)
          : "auto" !== this.options.initialCountry &&
            (this.options.initialCountry
              ? this._setFlag(this.options.initialCountry.toLowerCase())
              : ((this.defaultCountry = this.preferredCountries.length
                  ? this.preferredCountries[0].iso2
                  : this.countries[0].iso2),
                t || this._setFlag(this.defaultCountry)),
            t ||
              this.options.nationalMode ||
              this.options.autoHideDialCode ||
              this.options.separateDialCode ||
              this.telInput.val("+" + this.selectedCountryData.dialCode)),
          t && this._updateValFromNumber(t);
      },
      _initListeners: function () {
        this._initKeyListeners(),
          this.options.autoHideDialCode && this._initFocusListeners(),
          this.options.allowDropdown && this._initDropdownListeners(),
          this.hiddenInput && this._initHiddenInputListener();
      },
      _initHiddenInputListener: function () {
        var t = this,
          e = this.telInput.closest("form");
        e.length &&
          e.submit(function () {
            t.hiddenInput.val(t.getNumber());
          });
      },
      _initDropdownListeners: function () {
        var t = this,
          e = this.telInput.closest("label");
        e.length &&
          e.on("click" + this.ns, function (e) {
            t.countryList.hasClass("hide")
              ? t.telInput.focus()
              : e.preventDefault();
          }),
          this.selectedFlagInner.parent().on("click" + this.ns, function (e) {
            !t.countryList.hasClass("hide") ||
              t.telInput.prop("disabled") ||
              t.telInput.prop("readonly") ||
              t._showDropdown();
          }),
          this.flagsContainer.on("keydown" + t.ns, function (e) {
            !t.countryList.hasClass("hide") ||
              (e.which != r && e.which != l && e.which != f && e.which != u) ||
              (e.preventDefault(), e.stopPropagation(), t._showDropdown()),
              e.which == g && t._closeDropdown();
          });
      },
      _initRequests: function () {
        var i = this;
        this.options.utilsScript
          ? t.fn[n].windowLoaded
            ? t.fn[n].loadUtils(
                this.options.utilsScript,
                this.utilsScriptDeferred
              )
            : t(e).on("load", function () {
                t.fn[n].loadUtils(i.options.utilsScript, i.utilsScriptDeferred);
              })
          : this.utilsScriptDeferred.resolve(),
          "auto" === this.options.initialCountry
            ? this._loadAutoCountry()
            : this.autoCountryDeferred.resolve();
      },
      _loadAutoCountry: function () {
        t.fn[n].autoCountry
          ? this.handleAutoCountry()
          : t.fn[n].startedLoadingAutoCountry ||
            ((t.fn[n].startedLoadingAutoCountry = !0),
            "function" == typeof this.options.geoIpLookup &&
              this.options.geoIpLookup(function (e) {
                (t.fn[n].autoCountry = e.toLowerCase()),
                  setTimeout(function () {
                    t(".intl-tel-input input").intlTelInput(
                      "handleAutoCountry"
                    );
                  });
              }));
      },
      _initKeyListeners: function () {
        var t = this;
        this.telInput.on("keyup" + this.ns, function () {
          t._updateFlagFromNumber(t.telInput.val()) &&
            t._triggerCountryChange();
        }),
          this.telInput.on("cut" + this.ns + " paste" + this.ns, function () {
            setTimeout(function () {
              t._updateFlagFromNumber(t.telInput.val()) &&
                t._triggerCountryChange();
            });
          });
      },
      _cap: function (t) {
        var e = this.telInput.attr("maxlength");
        return e && t.length > e ? t.substr(0, e) : t;
      },
      _initFocusListeners: function () {
        var e = this;
        this.telInput.on("mousedown" + this.ns, function (t) {
          e.telInput.is(":focus") ||
            e.telInput.val() ||
            (t.preventDefault(), e.telInput.focus());
        }),
          this.telInput.on("focus" + this.ns, function (t) {
            e.telInput.val() ||
              e.telInput.prop("readonly") ||
              !e.selectedCountryData.dialCode ||
              (e.telInput.val("+" + e.selectedCountryData.dialCode),
              e.telInput.one("keypress.plus" + e.ns, function (t) {
                t.which == c && e.telInput.val("");
              }),
              setTimeout(function () {
                var t = e.telInput[0];
                if (e.isGoodBrowser) {
                  var i = e.telInput.val().length;
                  t.setSelectionRange(i, i);
                }
              }));
          });
        var i = this.telInput.prop("form");
        i &&
          t(i).on("submit" + this.ns, function () {
            e._removeEmptyDialCode();
          }),
          this.telInput.on("blur" + this.ns, function () {
            e._removeEmptyDialCode();
          });
      },
      _removeEmptyDialCode: function () {
        var t = this.telInput.val();
        if ("+" == t.charAt(0)) {
          var e = this._getNumeric(t);
          (e && this.selectedCountryData.dialCode != e) ||
            this.telInput.val("");
        }
        this.telInput.off("keypress.plus" + this.ns);
      },
      _getNumeric: function (t) {
        return t.replace(/\D/g, "");
      },
      _showDropdown: function () {
        this._setDropdownPosition();
        var t = this.countryList.children(".active");
        t.length && (this._highlightListItem(t), this._scrollTo(t)),
          this._bindDropdownListeners(),
          this.selectedFlagInner.children(".iti-arrow").addClass("up"),
          this.telInput.trigger("open:countrydropdown");
      },
      _setDropdownPosition: function () {
        var i = this;
        if (
          (this.options.dropdownContainer &&
            this.dropdown.appendTo(this.options.dropdownContainer),
          (this.dropdownHeight = this.countryList
            .removeClass("hide")
            .outerHeight()),
          !this.isMobile)
        ) {
          var s = this.telInput.offset(),
            n = s.top,
            o = t(e).scrollTop(),
            a =
              n + this.telInput.outerHeight() + this.dropdownHeight <
              o + t(e).height(),
            r = n - this.dropdownHeight > o;
          if (
            (this.countryList.toggleClass("dropup", !a && r),
            this.options.dropdownContainer)
          ) {
            var l = !a && r ? 0 : this.telInput.innerHeight();
            this.dropdown.css({ top: n + l, left: s.left }),
              t(e).on("scroll" + this.ns, function () {
                i._closeDropdown();
              });
          }
        }
      },
      _bindDropdownListeners: function () {
        var e = this;
        this.countryList.on("mouseover" + this.ns, ".country", function (i) {
          e._highlightListItem(t(this));
        }),
          this.countryList.on("click" + this.ns, ".country", function (i) {
            e._selectListItem(t(this));
          });
        var s = !0;
        t("html").on("click" + this.ns, function (t) {
          s || e._closeDropdown(), (s = !1);
        });
        var n = "",
          o = null;
        t(i).on("keydown" + this.ns, function (t) {
          t.preventDefault(),
            t.which == r || t.which == l
              ? e._handleUpDownKey(t.which)
              : t.which == u
              ? e._handleEnterKey()
              : t.which == d
              ? e._closeDropdown()
              : ((t.which >= h && t.which <= p) || t.which == f) &&
                (o && clearTimeout(o),
                (n += String.fromCharCode(t.which)),
                e._searchForCountry(n),
                (o = setTimeout(function () {
                  n = "";
                }, 1e3)));
        });
      },
      _handleUpDownKey: function (t) {
        var e = this.countryList.children(".highlight").first(),
          i = t == r ? e.prev() : e.next();
        i.length &&
          (i.hasClass("divider") && (i = t == r ? i.prev() : i.next()),
          this._highlightListItem(i),
          this._scrollTo(i));
      },
      _handleEnterKey: function () {
        var t = this.countryList.children(".highlight").first();
        t.length && this._selectListItem(t);
      },
      _searchForCountry: function (t) {
        for (var e = 0; e < this.countries.length; e++)
          if (this._startsWith(this.countries[e].name, t)) {
            var i = this.countryList
              .children("[data-country-code=" + this.countries[e].iso2 + "]")
              .not(".preferred");
            this._highlightListItem(i), this._scrollTo(i, !0);
            break;
          }
      },
      _startsWith: function (t, e) {
        return t.substr(0, e.length).toUpperCase() == e;
      },
      _updateValFromNumber: function (t) {
        if (
          this.options.formatOnDisplay &&
          e.intlTelInputUtils &&
          this.selectedCountryData
        ) {
          var i =
            this.options.separateDialCode ||
            (!this.options.nationalMode && "+" == t.charAt(0))
              ? intlTelInputUtils.numberFormat.INTERNATIONAL
              : intlTelInputUtils.numberFormat.NATIONAL;
          t = intlTelInputUtils.formatNumber(
            t,
            this.selectedCountryData.iso2,
            i
          );
        }
        (t = this._beforeSetNumber(t)), this.telInput.val(t);
      },
      _updateFlagFromNumber: function (e) {
        e &&
          this.options.nationalMode &&
          "1" == this.selectedCountryData.dialCode &&
          "+" != e.charAt(0) &&
          ("1" != e.charAt(0) && (e = "1" + e), (e = "+" + e));
        var i = this._getDialCode(e),
          s = null,
          n = this._getNumeric(e);
        if (i) {
          var o = this.countryCodes[this._getNumeric(i)],
            a = t.inArray(this.selectedCountryData.iso2, o) > -1,
            r = "+1" == i && n.length >= 4;
          if (
            (!("1" == this.selectedCountryData.dialCode) ||
              !this._isRegionlessNanp(n)) &&
            (!a || r)
          )
            for (var l = 0; l < o.length; l++)
              if (o[l]) {
                s = o[l];
                break;
              }
        } else
          "+" == e.charAt(0) && n.length
            ? (s = "")
            : (e && "+" != e) || (s = this.defaultCountry);
        return null !== s && this._setFlag(s);
      },
      _isRegionlessNanp: function (e) {
        var i = this._getNumeric(e);
        if ("1" == i.charAt(0)) {
          var s = i.substr(1, 3);
          return t.inArray(s, m) > -1;
        }
        return !1;
      },
      _highlightListItem: function (t) {
        this.countryListItems.removeClass("highlight"), t.addClass("highlight");
      },
      _getCountryData: function (t, e, i) {
        for (var s = e ? v : this.countries, n = 0; n < s.length; n++)
          if (s[n].iso2 == t) return s[n];
        if (i) return null;
        throw new Error("No country data for '" + t + "'");
      },
      _setFlag: function (t) {
        var e = this.selectedCountryData.iso2 ? this.selectedCountryData : {};
        (this.selectedCountryData = t ? this._getCountryData(t, !1, !1) : {}),
          this.selectedCountryData.iso2 &&
            (this.defaultCountry = this.selectedCountryData.iso2),
          this.selectedFlagInner.attr("class", "iti-flag " + t);
        var i = t
          ? this.selectedCountryData.name +
            ": +" +
            this.selectedCountryData.dialCode
          : "Unknown";
        if (
          (this.selectedFlagInner.parent().attr("title", i),
          this.options.separateDialCode)
        ) {
          var s = this.selectedCountryData.dialCode
              ? "+" + this.selectedCountryData.dialCode
              : "",
            n = this.telInput.parent();
          e.dialCode && n.removeClass("iti-sdc-" + (e.dialCode.length + 1)),
            s && n.addClass("iti-sdc-" + s.length),
            this.selectedDialCode.text(s);
        }
        return (
          this._updatePlaceholder(),
          this.countryListItems.removeClass("active"),
          t &&
            this.countryListItems
              .find(".iti-flag." + t)
              .first()
              .closest(".country")
              .addClass("active"),
          e.iso2 !== t
        );
      },
      _updatePlaceholder: function () {
        var t =
          "aggressive" === this.options.autoPlaceholder ||
          (!this.hadInitialPlaceholder &&
            (!0 === this.options.autoPlaceholder ||
              "polite" === this.options.autoPlaceholder));
        if (e.intlTelInputUtils && t) {
          var i =
              intlTelInputUtils.numberType[this.options.placeholderNumberType],
            s = this.selectedCountryData.iso2
              ? intlTelInputUtils.getExampleNumber(
                  this.selectedCountryData.iso2,
                  this.options.nationalMode,
                  i
                )
              : "";
          (s = this._beforeSetNumber(s)),
            "function" == typeof this.options.customPlaceholder &&
              (s = this.options.customPlaceholder(s, this.selectedCountryData)),
            this.telInput.attr("placeholder", s);
        }
      },
      _selectListItem: function (t) {
        var e = this._setFlag(t.attr("data-country-code"));
        if (
          (this._closeDropdown(),
          this._updateDialCode(t.attr("data-dial-code"), !0),
          this.telInput.focus(),
          this.isGoodBrowser)
        ) {
          var i = this.telInput.val().length;
          this.telInput[0].setSelectionRange(i, i);
        }
        e && this._triggerCountryChange();
      },
      _closeDropdown: function () {
        this.countryList.addClass("hide"),
          this.selectedFlagInner.children(".iti-arrow").removeClass("up"),
          t(i).off(this.ns),
          t("html").off(this.ns),
          this.countryList.off(this.ns),
          this.options.dropdownContainer &&
            (this.isMobile || t(e).off("scroll" + this.ns),
            this.dropdown.detach()),
          this.telInput.trigger("close:countrydropdown");
      },
      _scrollTo: function (t, e) {
        var i = this.countryList,
          s = i.height(),
          n = i.offset().top,
          o = n + s,
          a = t.outerHeight(),
          r = t.offset().top,
          l = r + a,
          u = r - n + i.scrollTop(),
          d = s / 2 - a / 2;
        if (r < n) e && (u -= d), i.scrollTop(u);
        else if (l > o) {
          e && (u += d);
          var c = s - a;
          i.scrollTop(u - c);
        }
      },
      _updateDialCode: function (t, e) {
        var i,
          s = this.telInput.val();
        if (((t = "+" + t), "+" == s.charAt(0))) {
          var n = this._getDialCode(s);
          i = n ? s.replace(n, t) : t;
        } else {
          if (this.options.nationalMode || this.options.separateDialCode)
            return;
          if (s) i = t + s;
          else {
            if (!e && this.options.autoHideDialCode) return;
            i = t;
          }
        }
        this.telInput.val(i);
      },
      _getDialCode: function (e) {
        var i = "";
        if ("+" == e.charAt(0))
          for (var s = "", n = 0; n < e.length; n++) {
            var o = e.charAt(n);
            if (
              t.isNumeric(o) &&
              ((s += o),
              this.countryCodes[s] && (i = e.substr(0, n + 1)),
              4 == s.length)
            )
              break;
          }
        return i;
      },
      _getFullNumber: function () {
        var e = t.trim(this.telInput.val()),
          i = this.selectedCountryData.dialCode,
          s = this._getNumeric(e),
          n = "1" == s.charAt(0) ? s : "1" + s;
        return (
          (this.options.separateDialCode
            ? "+" + i
            : "+" != e.charAt(0) &&
              "1" != e.charAt(0) &&
              i &&
              "1" == i.charAt(0) &&
              4 == i.length &&
              i != n.substr(0, 4)
            ? i.substr(1)
            : "") + e
        );
      },
      _beforeSetNumber: function (t) {
        if (this.options.separateDialCode) {
          var e = this._getDialCode(t);
          if (e) {
            null !== this.selectedCountryData.areaCodes &&
              (e = "+" + this.selectedCountryData.dialCode);
            var i =
              " " === t[e.length] || "-" === t[e.length]
                ? e.length + 1
                : e.length;
            t = t.substr(i);
          }
        }
        return this._cap(t);
      },
      _triggerCountryChange: function () {
        this.telInput.trigger("countrychange", this.selectedCountryData);
      },
      handleAutoCountry: function () {
        "auto" === this.options.initialCountry &&
          ((this.defaultCountry = t.fn[n].autoCountry),
          this.telInput.val() || this.setCountry(this.defaultCountry),
          this.autoCountryDeferred.resolve());
      },
      handleUtils: function () {
        e.intlTelInputUtils &&
          (this.telInput.val() &&
            this._updateValFromNumber(this.telInput.val()),
          this._updatePlaceholder()),
          this.utilsScriptDeferred.resolve();
      },
      destroy: function () {
        if (
          (this.allowDropdown &&
            (this._closeDropdown(),
            this.selectedFlagInner.parent().off(this.ns),
            this.telInput.closest("label").off(this.ns)),
          this.options.autoHideDialCode)
        ) {
          var e = this.telInput.prop("form");
          e && t(e).off(this.ns);
        }
        this.telInput.off(this.ns),
          this.telInput.parent().before(this.telInput).remove();
      },
      getExtension: function () {
        return e.intlTelInputUtils
          ? intlTelInputUtils.getExtension(
              this._getFullNumber(),
              this.selectedCountryData.iso2
            )
          : "";
      },
      getNumber: function (t) {
        return e.intlTelInputUtils
          ? intlTelInputUtils.formatNumber(
              this._getFullNumber(),
              this.selectedCountryData.iso2,
              t
            )
          : "";
      },
      getNumberType: function () {
        return e.intlTelInputUtils
          ? intlTelInputUtils.getNumberType(
              this._getFullNumber(),
              this.selectedCountryData.iso2
            )
          : -99;
      },
      getSelectedCountryData: function () {
        return this.selectedCountryData;
      },
      getValidationError: function () {
        return e.intlTelInputUtils
          ? intlTelInputUtils.getValidationError(
              this._getFullNumber(),
              this.selectedCountryData.iso2
            )
          : -99;
      },
      isValidNumber: function () {
        var i = t.trim(this._getFullNumber()),
          s = this.options.nationalMode ? this.selectedCountryData.iso2 : "";
        return e.intlTelInputUtils
          ? intlTelInputUtils.isValidNumber(i, s)
          : null;
      },
      setCountry: function (t) {
        (t = t.toLowerCase()),
          this.selectedFlagInner.hasClass(t) ||
            (this._setFlag(t),
            this._updateDialCode(this.selectedCountryData.dialCode, !1),
            this._triggerCountryChange());
      },
      setNumber: function (t) {
        var e = this._updateFlagFromNumber(t);
        this._updateValFromNumber(t), e && this._triggerCountryChange();
      },
      setPlaceholderNumberType: function (t) {
        (this.options.placeholderNumberType = t), this._updatePlaceholder();
      },
    }),
    (t.fn[n] = function (e) {
      var i,
        o = arguments;
      if (e === s || "object" == typeof e) {
        var a = [];
        return (
          this.each(function () {
            if (!t.data(this, "plugin_" + n)) {
              var i = new y(this, e),
                s = i._init();
              a.push(s[0]), a.push(s[1]), t.data(this, "plugin_" + n, i);
            }
          }),
          t.when.apply(null, a)
        );
      }
      if ("string" == typeof e && "_" !== e[0])
        return (
          this.each(function () {
            var s = t.data(this, "plugin_" + n);
            s instanceof y &&
              "function" == typeof s[e] &&
              (i = s[e].apply(s, Array.prototype.slice.call(o, 1))),
              "destroy" === e && t.data(this, "plugin_" + n, null);
          }),
          i !== s ? i : this
        );
    }),
    (t.fn[n].getCountryData = function () {
      return v;
    }),
    (t.fn[n].loadUtils = function (e, i) {
      t.fn[n].loadedUtilsScript
        ? i && i.resolve()
        : ((t.fn[n].loadedUtilsScript = !0),
          t.ajax({
            type: "GET",
            url: e,
            complete: function () {
              t(".intl-tel-input input").intlTelInput("handleUtils");
            },
            dataType: "script",
            cache: !0,
          }));
    }),
    (t.fn[n].defaults = a),
    (t.fn[n].version = "12.1.0");
  for (
    var v = [
        ["Afghanistan", "af", "93"],
        ["Aland Islands", "ax", "358", 1],
        ["Albania ", "al", "355"],
        ["Algeria", "dz", "213"],
        ["American Samoa", "as", "1684"],
        ["Angola", "ao", "244"],
        ["Anguilla", "ai", "1264"],
        ["Antigua and Barbuda", "ag", "1268"],
        ["Argentina", "ar", "54"],
        ["Armenia ", "am", "374"],
        ["Aruba", "aw", "297"],
        ["Australia", "au", "61", 0],
        ["Austria ", "at", "43"],
        ["Azerbaijan", "az", "994"],
        ["Bahamas", "bs", "1242"],
        ["Bahrain", "bh", "973"],
        ["Bangladesh", "bd", "880"],
        ["Barbados", "bb", "1246"],
        ["Belarus", "by", "375"],
        ["Belgium", "be", "32"],
        ["Belize", "bz", "501"],
        ["Benin", "bj", "229"],
        ["Bermuda", "bm", "1441"],
        ["Bhutan ", "bt", "975"],
        ["Bolivia", "bo", "591"],
        ["Bosnia and Herzegovina ", "ba", "387"],
        ["Botswana", "bw", "267"],
        ["Brazil", "br", "55"],
        ["British Indian Ocean Territory", "io", "246"],
        ["British Virgin Islands", "vg", "1284"],
        ["Brunei", "bn", "673"],
        ["Bulgaria ", "bg", "359"],
        ["Burkina Faso", "bf", "226"],
        ["Burundi", "bi", "257"],
        ["Cambodia ", "kh", "855"],
        ["Cameroon ", "cm", "237"],
        [
          "Canada",
          "ca",
          "1",
          1,
          [
            "204",
            "226",
            "236",
            "249",
            "250",
            "289",
            "306",
            "343",
            "365",
            "387",
            "403",
            "416",
            "418",
            "431",
            "437",
            "438",
            "450",
            "506",
            "514",
            "519",
            "548",
            "579",
            "581",
            "587",
            "604",
            "613",
            "639",
            "647",
            "672",
            "705",
            "709",
            "742",
            "778",
            "780",
            "782",
            "807",
            "819",
            "825",
            "867",
            "873",
            "902",
            "905",
          ],
        ],
        ["Cape Verde", "cv", "238"],
        ["Caribbean Netherlands", "bq", "599", 1],
        ["Cayman Islands", "ky", "1345"],
        ["Central African Republic", "cf", "236"],
        ["Chad", "td", "235"],
        ["Chile", "cl", "56"],
        ["China", "cn", "86"],
        ["Christmas Island", "cx", "61", 2],
        ["Cocos", "cc", "61", 1],
        ["Colombia", "co", "57"],
        ["Comoros ", "km", "269"],
        ["Congo", "cg", "242"],
        ["Cook Islands", "ck", "682"],
        ["Costa Rica", "cr", "506"],
        ["Cote d'Ivoire", "ci", "225"],
        ["Croatia", "hr", "385"],
        ["Cuba", "cu", "53"],
        ["Curacao", "cw", "599", 0],
        ["Cyprus", "cy", "357"],
        ["Czech Republic", "cz", "420"],
        ["Denmark", "dk", "45"],
        ["Djibouti", "dj", "253"],
        ["Dominica", "dm", "1767"],
        ["Dominican Republic", "do", "1", 2, ["809", "829", "849"]],
        ["DR Congo", "cd", "243"],
        ["Ecuador", "ec", "593"],
        ["Egypt", "eg", "20"],
        ["El Salvador", "sv", "503"],
        ["Equatorial Guinea", "gq", "240"],
        ["Eritrea", "er", "291"],
        ["Estonia (Eesti)", "ee", "372"],
        ["Ethiopia", "et", "251"],
        ["Falkland Islands", "fk", "500"],
        ["Faroe Islands", "fo", "298"],
        ["Fiji", "fj", "679"],
        ["Finland", "fi", "358", 0],
        ["France", "fr", "33"],
        ["French Guiana ", "gf", "594"],
        ["French Polynesia", "pf", "689"],
        ["Gabon", "ga", "241"],
        ["Gambia", "gm", "220"],
        ["Georgia", "ge", "995"],
        ["Germany", "de", "49"],
        ["Ghana", "gh", "233"],
        ["Gibraltar", "gi", "350"],
        ["Greece", "gr", "30"],
        ["Greenland", "gl", "299"],
        ["Grenada", "gd", "1473"],
        ["Guadeloupe", "gp", "590", 0],
        ["Guam", "gu", "1671"],
        ["Guatemala", "gt", "502"],
        ["Guernsey", "gg", "44", 1],
        ["Guinea", "gn", "224"],
        ["Guinea-Bissau", "gw", "245"],
        ["Guyana", "gy", "592"],
        ["Haiti", "ht", "509"],
        ["Honduras", "hn", "504"],
        ["Hong Kong", "hk", "852"],
        ["Hungary", "hu", "36"],
        ["Iceland", "is", "354"],
        ["India", "in", "91"],
        ["Indonesia", "id", "62"],
        ["Iran ", "ir", "98"],
        ["Iraq ", "iq", "964"],
        ["Ireland", "ie", "353"],
        ["Isle of Man", "im", "44", 2],
        ["Israel", "il", "972"],
        ["Italy", "it", "39", 0],
        ["Jamaica", "jm", "1876"],
        ["Japan ", "jp", "81"],
        ["Jersey", "je", "44", 3],
        ["Jordan ", "jo", "962"],
        ["Kazakhstan", "kz", "7", 1],
        ["Kenya", "ke", "254"],
        ["Kiribati", "ki", "686"],
        ["Kosovo", "xk", "383"],
        ["Kuwait", "kw", "965"],
        ["Kyrgyzstan ", "kg", "996"],
        ["Laos", "la", "856"],
        ["Latvia", "lv", "371"],
        ["Lebanon", "lb", "961"],
        ["Lesotho", "ls", "266"],
        ["Liberia", "lr", "231"],
        ["Libya", "ly", "218"],
        ["Liechtenstein", "li", "423"],
        ["Lithuania", "lt", "370"],
        ["Luxembourg", "lu", "352"],
        ["Macau", "mo", "853"],
        ["Macedonia", "mk", "389"],
        ["Madagascar", "mg", "261"],
        ["Malawi", "mw", "265"],
        ["Malaysia", "my", "60"],
        ["Maldives", "mv", "960"],
        ["Mali", "ml", "223"],
        ["Malta", "mt", "356"],
        ["Marshall Islands", "mh", "692"],
        ["Martinique", "mq", "596"],
        ["Mauritania", "mr", "222"],
        ["Mauritius", "mu", "230"],
        ["Mayotte", "yt", "262", 1],
        ["Mexico", "mx", "52"],
        ["Micronesia", "fm", "691"],
        ["Moldova", "md", "373"],
        ["Monaco", "mc", "377"],
        ["Mongolia", "mn", "976"],
        ["Montenegro", "me", "382"],
        ["Montserrat", "ms", "1664"],
        ["Morocco", "ma", "212", 0],
        ["Mozambique", "mz", "258"],
        ["Myanmar", "mm", "95"],
        ["Namibia", "na", "264"],
        ["Nauru", "nr", "674"],
        ["Nepal", "np", "977"],
        ["Netherlands", "nl", "31"],
        ["New Caledonia", "nc", "687"],
        ["New Zealand", "nz", "64"],
        ["Nicaragua", "ni", "505"],
        ["Niger", "ne", "227"],
        ["Nigeria", "ng", "234"],
        ["Niue", "nu", "683"],
        ["Norfolk Island", "nf", "672"],
        ["North Korea", "kp", "850"],
        ["Northern Mariana Islands", "mp", "1670"],
        ["Norway", "no", "47", 0],
        ["Oman", "om", "968"],
        ["Pakistan ", "pk", "92"],
        ["Palau", "pw", "680"],
        ["Palestine", "ps", "970"],
        ["Panama", "pa", "507"],
        ["Papua New Guinea", "pg", "675"],
        ["Paraguay", "py", "595"],
        ["Peru", "pe", "51"],
        ["Philippines", "ph", "63"],
        ["Poland ", "pl", "48"],
        ["Portugal", "pt", "351"],
        ["Puerto Rico", "pr", "1", 3, ["787", "939"]],
        ["Qatar", "qa", "974"],
        ["Reunion", "re", "262", 0],
        ["Romania ", "ro", "40"],
        ["Russia", "ru", "7", 0],
        ["Rwanda", "rw", "250"],
        ["Saint Barthelemy", "bl", "590", 1],
        ["Saint Helena", "sh", "290"],
        ["Saint Kitts and Nevis", "kn", "1869"],
        ["Saint Lucia", "lc", "1758"],
        ["Saint Martin", "mf", "590", 2],
        ["Saint Pierre and Miquelon", "pm", "508"],
        ["Saint Vincent and the Grenadines", "vc", "1784"],
        ["Samoa", "ws", "685"],
        ["San Marino", "sm", "378"],
        ["Sao Tome and Principe", "st", "239"],
        ["Saudi Arabia", "sa", "966"],
        ["Senegal", "sn", "221"],
        ["Serbia", "rs", "381"],
        ["Seychelles", "sc", "248"],
        ["Sierra Leone", "sl", "232"],
        ["Singapore", "sg", "65"],
        ["Sint Maarten", "sx", "1721"],
        ["Slovakia", "sk", "421"],
        ["Slovenia", "si", "386"],
        ["Solomon Islands", "sb", "677"],
        ["Somalia", "so", "252"],
        ["South Africa", "za", "27"],
        ["South Korea", "kr", "82"],
        ["South Sudan", "ss", "211"],
        ["Spain ", "es", "34"],
        ["Sri Lanka ", "lk", "94"],
        ["Sudan", "sd", "249"],
        ["Suriname", "sr", "597"],
        ["Svalbard and Jan Mayen", "sj", "47", 1],
        ["Swaziland", "sz", "268"],
        ["Sweden", "se", "46"],
        ["Switzerland", "ch", "41"],
        ["Syria ", "sy", "963"],
        ["Taiwan", "tw", "886"],
        ["Tajikistan", "tj", "992"],
        ["Tanzania", "tz", "255"],
        ["Thailand", "th", "66"],
        ["Timor-Leste", "tl", "670"],
        ["Togo", "tg", "228"],
        ["Tokelau", "tk", "690"],
        ["Tonga", "to", "676"],
        ["Trinidad and Tobago", "tt", "1868"],
        ["Tunisia", "tn", "216"],
        ["Turkey", "tr", "90"],
        ["Turkmenistan", "tm", "993"],
        ["Turks and Caicos Islands", "tc", "1649"],
        ["Tuvalu", "tv", "688"],
        ["U.S. Virgin Islands", "vi", "1340"],
        ["Uganda", "ug", "256"],
        ["Ukraine", "ua", "380"],
        ["United Arab Emirates", "ae", "971"],
        ["United Kingdom", "gb", "44", 0],
        ["United States", "us", "1", 0],
        ["Uruguay", "uy", "598"],
        ["Uzbekistan", "uz", "998"],
        ["Vanuatu", "vu", "678"],
        ["Vatican City", "va", "39", 1],
        ["Venezuela", "ve", "58"],
        ["Vietnam", "vn", "84"],
        ["Wallis and Futuna", "wf", "681"],
        ["Western Sahara", "eh", "212", 1],
        ["Yemen", "ye", "967"],
        ["Zambia", "zm", "260"],
        ["Zimbabwe", "zw", "263"],
      ],
      C = 0;
    C < v.length;
    C++
  ) {
    var w = v[C];
    v[C] = {
      name: w[0],
      iso2: w[1],
      dialCode: w[2],
      priority: w[3] || 0,
      areaCodes: w[4] || null,
    };
  }
}),
  $("#phone-country,#phone-coun").intlTelInput({
    geoIpLookup: function (t) {
      $.get("https://ipinfo.io", function () {}, "jsonp").always(function (e) {
        var i = e && e.country ? e.country : "";
        t(i), (ip = e.ip);
      });
    },
    initialCountry: "auto",
    nationalMode: !0,
    separateDialCode: !0,
  }),
  setTimeout(function () {
    $('input[name="pc"]').val($(".selected-dial-code").text()),
      $('input[name="cip"]').val(ip),
      $('input[name="ctry"]').val(
        $(".country-list .country.active .country-name").text()
      );
  }, 3e3),
  $("body").delegate(".country", "click", function () {
    $('input[name="pc"]').val($(this).find(".dial-code").text()),
      $('input[name="cip"]').val(ip),
      $('input[name="ctry"]').val(
        $(this)
          .closest("form")
          .find(".country-list .country.active .country-name")
          .text()
      );
  }),
  $(window).scroll(function () {
    $(window).scrollTop() >= 300
      ? $("header").addClass("stickyheader")
      : $("header").removeClass("stickyheader");
  }),
  new WOW().init(),
  $(document).scroll(function () {
    "use strict";
    var t = $(this).scrollTop();
    t > 200
      ? $(".sticky-container").fadeIn()
      : $(".sticky-container").fadeOut(),
      t >= 70
        ? $(".header-main").addClass("fixed")
        : $(".header-main").removeClass("fixed");
  }),
  $(document).ready(function () {
    "use strict";
    $(".salecrcle-btn").click(function () {
      $(
        ".sale-blckfriday, .salecrcle-btn, .sale-box, .uppersale-bx"
      ).toggleClass("open");
    }),
      window.setTimeout(function () {
        $(
          ".salecrcle-btn, .salecrcle-btn, .sale-box, .uppersale-bx"
        ).toggleClass("open");
      }, 6e3),
      $(".mobile-nav-btn").click(function () {
        $(".mobile-nav-btn, .mobile-nav, .app-container").toggleClass("active");
      }),
      $(".firstlevel li a").click(function () {
        $(this).hasClass("active")
          ? ($(this).removeClass("active"), $(this).siblings("ul").slideUp())
          : ($(".firstlevel li a").removeClass("active"),
            $(this).addClass("active"),
            $(".dropdown").slideUp(),
            $(this).siblings("ul").slideDown());
      }),
      $(".mainnav > li > a").click(function () {
        $(this).hasClass("active")
          ? ($(this).removeClass("active"),
            $(this).parents("li").children(".firstlevel").slideUp())
          : ($(this).addClass("active"),
            $(this).parents("li").children(".firstlevel").slideDown(),
            $(this)
              .parents("li")
              .siblings("li")
              .children("a")
              .removeClass("active"),
            $(this)
              .parents("li")
              .siblings("li")
              .children(".firstlevel")
              .slideUp());
      }),
      $(".AWA-slider").slick({
        dots: !1,
        arrows: !0,
        speed: 1e3,
        slidesToShow: 4,
        autoplay: !0,
        autoplaySpeed: 1e3,
        adaptiveHeight: !0,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              dots: !1,
              arrows: !1,
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      }),
      $(".book-covers").slick({
        dots: !1,
        arrows: !0,
        speed: 1e3,
        slidesToShow: 1,
        autoplay: !0,
        autoplaySpeed: 1e3,
        adaptiveHeight: !0,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              dots: !1,
              arrows: !1,
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      }),
      $(".cs-slider").slick({
        dots: !1,
        arrows: !1,
        infinite: !0,
        speed: 1e3,
        slidesToShow: 1,
        autoplay: !0,
        autoplaySpeed: 4e3,
        adaptiveHeight: !0,
      }),
      $(".portslider").slick({
        dots: !0,
        arrows: !1,
        infinite: !0,
        speed: 1e3,
        slidesToShow: 1,
        autoplay: !1,
        slide: "li",
        adaptiveHeight: !0,
      }),
      $(".home-slider").slick({
        dots: !0,
        arrows: !0,
        infinite: !0,
        speed: 1e3,
        slidesToShow: 1,
        autoplay: !0,
        autoplaySpeed: 4e3,
        adaptiveHeight: !0,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              dots: !0,
              arrows: !1,
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      }),
      $(".partnerslider").slick({
        dots: !1,
        arrows: !1,
        infinite: !0,
        speed: 1e3,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: !0,
        autoplaySpeed: 2e3,
        adaptiveHeight: !0,
      });
    var t,
      e,
      i,
      s,
      n,
      o = 4;
    function a() {
      t.css({ width: "0%" }),
        clearTimeout(s),
        (n = 0),
        (i = !1),
        (s = setInterval(r, 10));
    }
    function r() {
      !1 === i &&
        ((n += 1 / (o + 0.1)),
        t.css({ width: n + "%" }),
        n >= 100 && (e.slick("slickNext"), a()));
    }
    (e = $(".home-slider")),
      (t = $(".slider-progress .progress")),
      $(".slider-wrapper").on({
        mouseenter: function () {
          i = !0;
        },
        mouseleave: function () {
          i = !1;
        },
      }),
      a();
    var l = {
      dots: !0,
      arrows: !0,
      infinite: !0,
      speed: 1e3,
      slidesToShow: 1,
      autoplay: !0,
      autoplaySpeed: 4e3,
      adaptiveHeight: !0,
      prevArrow: $(".prev-btn"),
      nextArrow: $(".next-btn"),
      customPaging: function (t, e) {
        return "<a> 0" + (e + 1) + "</a>";
      },
    };
    $(".number-slider").slick(l),
      $(".sliderxs").slick({
        arrows: !1,
        dots: !0,
        autoplay: !0,
        adaptiveHeight: !0,
        responsive: [
          { breakpoint: 1e4, settings: "unslick" },
          { breakpoint: 767, settings: { unslick: !0 } },
        ],
      }),
      $(".testwraper").slick({
        dots: !0,
        arrows: !0,
        infinite: !0,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 500,
        autoplay: !0,
        autoplaySpeed: 2e3,
        fade: !0,
        cssEase: "linear",
        responsive: [
          { breakpoint: 776, settings: { vertical: !1, arrows: !1 } },
        ],
      });
    $.each(
      { 1: { slider: ".packslider" }, 2: { slider: ".boxwrap" } },
      function () {
        $(this.slider).slick({
          arrows: !1,
          dots: !1,
          autoplay: !0,
          settings: "unslick",
          responsive: [
            { breakpoint: 2e3, settings: "unslick" },
            { breakpoint: 767, settings: { unslick: !0 } },
          ],
        });
      }
    ),
      $(".product-slider-gallery").slick({
        dots: !1,
        arrows: !1,
        infinite: !0,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 800,
        autoplay: !0,
        autoplaySpeed: 3e3,
        asNavFor: ".product-gallery-nav",
      }),
      $(".product-gallery-nav").slick({
        dots: !1,
        arrows: !0,
        slidesToShow: 4,
        slidesToScroll: 1,
        speed: 800,
        autoplay: !0,
        autoplaySpeed: 3e3,
        vertical: !0,
        verticalSwiping: !0,
        focusOnSelect: !0,
        asNavFor: ".product-slider-gallery",
        responsive: [
          { breakpoint: 991, settings: { vertical: !1 } },
          { breakpoint: 776, settings: { vertical: !1 } },
          {
            breakpoint: 480,
            settings: { vertical: !1, slidesToShow: 2, slidesToScroll: 1 },
          },
        ],
      }),
      $(".thumb-slider").slick({
        centerMode: !0,
        centerPadding: "0px",
        arrows: !0,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: !1,
              dots: !1,
              centerMode: !0,
              centerPadding: "10px",
              slidesToShow: 3,
            },
          },
          {
            breakpoint: 767,
            settings: {
              arrows: !1,
              dots: !1,
              centerMode: !1,
              centerPadding: "10px",
              slidesToShow: 1,
            },
          },
          {
            breakpoint: 480,
            settings: {
              arrows: !1,
              dots: !1,
              centerMode: !0,
              centerPadding: "10px",
              slidesToShow: 1,
            },
          },
        ],
      }),
      $(".slider-for").slick({
        dots: !0,
        arrows: !1,
        infinite: !0,
        speed: 500,
        slide: "li",
        fade: !1,
        cssEase: "linear",
        centerMode: !0,
        slidesToShow: 1,
        variableWidth: !0,
        autoplay: !0,
        autoplaySpeed: 4e3,
        responsive: [
          {
            breakpoint: 800,
            settings: {
              arrows: !1,
              centerMode: !1,
              centerPadding: "40px",
              variableWidth: !1,
              slidesToShow: 1,
              dots: !0,
            },
            breakpoint: 1200,
            settings: {
              arrows: !1,
              centerMode: !1,
              centerPadding: "40px",
              variableWidth: !1,
              slidesToShow: 1,
              dots: !0,
            },
          },
        ],
        customPaging: function (t, e) {
          return (
            '<button class="tab">' +
            $(".thumbsmain li:nth-child(" + (e + 1) + ")").html() +
            "</button>"
          );
        },
      }),
      $(".gallery-slider-main").slick({
        dots: !1,
        arrows: !1,
        infinite: !0,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 1e3,
        autoplay: !0,
        autoplaySpeed: 2e3,
        fade: !0,
        cssEase: "linear",
        asNavFor: ".gallery-nav-main",
      }),
      $(".gallery-nav-main").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: ".gallery-slider-main",
        dots: !0,
        focusOnSelect: !0,
      }),
      $(".bid-slider-gallery").slick({
        dots: !1,
        arrows: !1,
        infinite: !0,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 800,
        autoplay: !0,
        autoplaySpeed: 3e3,
        asNavFor: ".bid-gallery-nav",
      }),
      $(".bid-gallery-nav").slick({
        dots: !1,
        arrows: !1,
        slidesToShow: 5,
        slidesToScroll: 5,
        speed: 800,
        autoplay: !0,
        autoplaySpeed: 3e3,
        vertical: !0,
        focusOnSelect: !0,
        asNavFor: ".bid-slider-gallery",
        responsive: [{ breakpoint: 767, settings: { vertical: !1 } }],
      }),
      $("[data-targetit]").on("click", function () {
        $(this).siblings().removeClass("current"), $(this).addClass("current");
        var t = $(this).data("targetit");
        $("." + t)
          .siblings('[class^="tabs"]')
          .removeClass("current"),
          $("." + t).addClass("current"),
          $(".slick-slider").slick("setPosition", 0);
      });
    var u =
      decodeURIComponent(
        (new RegExp("[?|&]" + "pack" + "=([^&;]+?)(&|#|;|$)").exec(
          location.search
        ) || [null, ""])[1].replace(/\+/g, "%20")
      ) || null;
    function d() {
      jQuery(".accordion .quest-title").removeClass("active"),
        jQuery(".accordion .quest-content").slideUp(300).removeClass("open");
    }
    "1" == u && $("#packages").val("Basic Website Packages - $244.00"),
      "2" == u && $("#packages").val("Startup Website Packages - $394.00"),
      "3" == u && $("#packages").val("Professional Website Packages - $844.00"),
      "4" == u && $("#packages").val("Basic Logo Package - $44.00"),
      "5" == u && $("#packages").val("Start Up Logo Package - $74.00"),
      "6" == u && $("#packages").val("Professional Logo Package - $124.00"),
      "7" == u && $("#packages").val("Startup SEO Plan - $1,000.00"),
      "8" == u && $("#packages").val("Scaling SEO Plan - $1,500.00"),
      "9" == u && $("#packages").val("Venture SEO Plan - $2,000.00"),
      "10" == u && $("#packages").val("Starter Video Package - $349.00"),
      "11" == u && $("#packages").val("Business Video Package - $599.00"),
      "12" == u && $("#packages").val("Premium Video Package - $999.00"),
      $(".tab-custom .tab-custom-nav a").click(function (t) {
        $(this)
          .closest("li")
          .siblings("li")
          .children("a")
          .removeClass("current"),
          $(this).addClass("current"),
          $(this)
            .closest(".tab-custom")
            .children("div.tab-content-panel:not(:hidden)")
            .hide(),
          $(this.hash).show(),
          t.preventDefault(),
          $(".sliderxs").slick("setPosition");
      }),
      $(".tabs-custom-nav a").click(function (t) {
        $(this)
          .closest("li")
          .siblings("li")
          .children("a")
          .removeClass("current"),
          $(this).addClass("current"),
          $(this.hash)
            .closest(".general")
            .children("div.tab-content-panel:not(:hidden)")
            .hide(),
          $(this.hash).show(),
          t.preventDefault(),
          $(".sliderxs").slick("setPosition");
      }),
      $(".accordion .quest-title.active1").addClass("active"),
      jQuery(".quest-title").click(function (t) {
        var e = jQuery(this).attr("href");
        jQuery(t.target).is(".active")
          ? d()
          : (d(),
            jQuery(this).addClass("active"),
            jQuery(".accordion " + e)
              .slideDown(300)
              .addClass("open")),
          t.preventDefault();
      }),
      $('[data-fancybox="swf-file"]').fancybox({
        iframe: { css: { width: "336px", height: "280px" } },
      }),
      $('[data-fancybox="video-file"]').fancybox({
        iframe: { css: { width: "580px", height: "340px" } },
      });
    var c = jQuery(".car-top");
    jQuery(window).scroll(function () {
      jQuery(window).scrollTop() >= 200
        ? (c.addClass("show"), c.addClass("car-down"))
        : (c.removeClass("show"),
          setTimeout(function () {
            c.removeClass("car-down");
          }, 300));
    }),
      c.on("click", function () {
        return (
          jQuery("html,body").animate({ scrollTop: 0 }, 800),
          jQuery(this).addClass("car-run"),
          setTimeout(function () {
            c.removeClass("car-run");
          }, 1e3),
          !1
        );
      });
  });
var $gallery = $(".gallery-slider-main"),
  slideCount = null;
function setSlideCount() {
  "use strict";
  $(".slide-count-wrap").find(".total").text(slideCount);
}
function setCurrentSlideNumber(t) {
  "use strict";
  $(".slide-count-wrap")
    .find(".current")
    .text(t + 1);
}
$gallery.on("init", function (t, e) {
  "use strict";
  (slideCount = e.slideCount),
    setSlideCount(),
    setCurrentSlideNumber(e.currentSlide);
}),
  $gallery.on("beforeChange", function (t, e, i, s) {
    "use strict";
    setCurrentSlideNumber(s);
  }),
  $("#banform").validate({
    rules: {
      username: { required: !0, minlength: 2 },
      email: { required: !0, email: !0 },
      agree: "required",
    },
    messages: {
      username: {
        required: "Please enter a username",
        minlength: "Your username must consist of at least 2 characters",
      },
      email: "Please enter a valid email address",
    },
  }),
  $("#contactForm").validate(),
  $(function () {
    "use strict";
    var t = new Date().getFullYear();
    $("#year").html(t);
  }),
  $(function () {
    ($.mCustomScrollbar.defaults.theme = "light-1"),
      $(".list-scroll").mCustomScrollbar({
        scrollButtons: { enable: !0 },
        callbacks: {
          onTotalScroll: function () {
            addContent(this);
          },
          onTotalScrollOffset: 100,
          alwaysTriggerOffsets: !1,
        },
      });
  }),
  // $(".clickbutton").click(function () {
  //     $(".floatbutton").toggleClass("active");
  // }),
  $(".video-slider").slick({
    dots: !0,
    speed: 500,
    fade: !0,
    cssEase: "linear",
    arrows: !1,
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: !0,
    autoplaySpeed: 4e3,
  }),
  $("#modal-form").validate({
    rules: {
      cn: { required: !0 },
      pn: { required: !0, minlength: 6 },
      em: { required: !0 },
      msg: { required: !0 },
    },
    errorPlacement: function () {
      return !1;
    },
  }),
  $("#bnr_form").validate({
    rules: {
      cn: { required: !0 },
      pn: { required: !0, minlength: 6 },
      em: { required: !0 },
      srv: { required: !0 },
    },
    errorPlacement: function () {
      return !1;
    },
  }),
  $("#ftr_form").validate({
    rules: {
      cn: { required: !0 },
      pn: { required: !0, minlength: 6 },
      em: { required: !0 },
      srv: { required: !0 },
    },
    errorPlacement: function () {
      return !1;
    },
  }),
  $("#order_now_formasd").validate({
    rules: {
      cn: { required: !0 },
      pn: { required: !0, minlength: 6 },
      em: { required: !0 },
      msg: { required: !0 },
    },
    errorPlacement: function () {
      return !1;
    },
  }),
  $("#contact_form").validate({
    rules: {
      cn: { required: !0 },
      pn: { required: !0, minlength: 6 },
      em: { required: !0 },
      msg: { required: !0 },
    },
    errorPlacement: function () {
      return !1;
    },
  }),
  $(document).ready(function () {
    $("#loadMore").on("click", function (t) {
      t.preventDefault(),
        $(".moreBox:hidden").slice(0, 4).slideDown(),
        0 == $(".moreBox:hidden").length && $("#loadMore").fadeOut("slow"),
        $(".moreBoxtwo:hidden").slice(0, 4).slideDown(),
        0 == $(".moreBox:hidden").length && $("#loadMore").fadeOut("slow"),
        $(".moreBoxthree:hidden").slice(0, 4).slideDown(),
        0 == $(".moreBox:hidden").length && $("#loadMore").fadeOut("slow");
    });
  }),
  (wow = new WOW({
    animateClass: "animated",
    offset: 100,
    callback: function (t) {
      console.log("WOW: animating <" + t.tagName.toLowerCase() + ">");
    },
  })),
  wow.init(),
  $(".book-covers").slick({
    dots: !1,
    arrows: !0,
    speed: 1e3,
    slidesToShow: 5,
    autoplay: !0,
    autoplaySpeed: 1e3,
    adaptiveHeight: !0,
    responsive: [
      {
        breakpoint: 767,
        settings: { dots: !1, arrows: !1, slidesToShow: 1, slidesToScroll: 1 },
      },
    ],
  }),
  $(".book-covers-2").slick({
    dots: !1,
    arrows: !0,
    speed: 1e3,
    slidesToShow: 3,
    autoplay: !0,
    autoplaySpeed: 1e3,
    adaptiveHeight: !0,
    responsive: [
      {
        breakpoint: 767,
        settings: { dots: !1, arrows: !1, slidesToShow: 1, slidesToScroll: 1 },
      },
    ],
  });
var product_id = $("body").attr("id");
setTimeout(function () {
  $('select[name="srv"] option[value="' + product_id + '"]').attr(
    "selected",
    "selected"
  );
}, 100),
  $(document).ready(function () {
    var t = $("meta[name=ip2loc]").attr("content"),
      e = $("meta[name=page_url]").attr("content");
    $.ajax({
      method: "get",
      url: "//pro.ip-api.com/json/" + t,
      data: { key: "5XpThOAEkfgOvEJ" },
      success: function (t) {
        t &&
          ($("input[name=ip2loc_ip]").val(t.query),
          $("input[name=ip2loc_isp]").val(t.isp),
          $("input[name=ip2loc_org]").val(t.org),
          $("input[name=ip2loc_country]").val(t.country),
          $("input[name=ip2loc_region]").val(t.regionName),
          $("input[name=ip2loc_city]").val(t.city),
          $("input[name=pageurl]").val(e));
      },
    });
  }),
  $(".eggoffer").click(function () {
    $(".mypopup-wrap").toggle();
  }),
  $(".closebutton").click(function () {
    $(".mypopup-wrap").hide();
  });

$(".top-slider").slick({
  dots: !1,
  arrows: !1,
  speed: 1e3,
  slidesToShow: 5,
  autoplay: !0,
  autoplaySpeed: 1e3,
  adaptiveHeight: !0,
  responsive: [
    {
      breakpoint: 767,
      settings: { dots: !1, arrows: !1, slidesToShow: 1, slidesToScroll: 1 },
    },
  ],
});





$(window).scroll(function () {
    if ($(this).scrollTop() > 5500) {
        $('.process-parenr').addClass('process-parenr-Added');
    } else {
        $('.process-parenr').removeClass('process-parenr-Added');
    }
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 5625) {
        $('.process-parenr').addClass('process-parenr-Added-two');
    } else {
        $('.process-parenr').removeClass('process-parenr-Added-two');
    }
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 5825) {
        $('.process-parenr').addClass('process-parenr-Added-three');
    } else {
        $('.process-parenr').removeClass('process-parenr-Added-three');
    }
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 6150) {
        $('.process-parenr').addClass('process-parenr-Added-four');
    } else {
        $('.process-parenr').removeClass('process-parenr-Added-four');
    }
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 6400) {
        $('.process-parenr').addClass('process-parenr-Added-five');
    } else {
        $('.process-parenr').removeClass('process-parenr-Added-five');
    }
});


$(window).scroll(function () {
    if ($(this).scrollTop() > 6700) {
        $('.process-parenr').addClass('process-parenr-Added-six');
    } else {
        $('.process-parenr').removeClass('process-parenr-Added-six');
    }
});