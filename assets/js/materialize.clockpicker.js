
!function(){function t(t){return document.createElementNS(r,t)}function i(t){return(t<10?"0":"")+t}function e(t){var i=++v+"";return t?t+i:i}function s(s,n){function r(t,i){var e=h.offset(),s=/^touch/.test(t.type),o=e.left+f,c=e.top+f,r=(s?t.originalEvent.touches[0]:t).pageX-o,l=(s?t.originalEvent.touches[0]:t).pageY-c,u=Math.sqrt(r*r+l*l),m=!1;if(!i||!(u<b-w||u>b+w)){t.preventDefault();var v=setTimeout(function(){V.popover.addClass("clockpicker-moving")},200);p&&h.append(V.canvas),V.setHand(r,l,!i,!0),a.off(d).on(d,function(t){t.preventDefault();var i=/^touch/.test(t.type),e=(i?t.originalEvent.touches[0]:t).pageX-o,s=(i?t.originalEvent.touches[0]:t).pageY-c;(m||e!==r||s!==l)&&(m=!0,V.setHand(e,s,!1,!0))}),a.off(k).on(k,function(t){a.off(k),t.preventDefault();var e=/^touch/.test(t.type),s=(e?t.originalEvent.changedTouches[0]:t).pageX-o,p=(e?t.originalEvent.changedTouches[0]:t).pageY-c;(i||m)&&s===r&&p===l&&V.setHand(s,p),"hours"===V.currentView?V.toggleView("minutes",A/2):n.autoclose&&(V.minutesView.addClass("clockpicker-dial-out"),setTimeout(function(){V.done()},A/2)),h.prepend(z),clearTimeout(v),V.popover.removeClass("clockpicker-moving"),a.off(d)})}}var l=c(M),h=l.find(".clockpicker-plate"),m=l.find(".picker__holder"),v=l.find(".clockpicker-hours"),P=l.find(".clockpicker-minutes"),C=l.find(".clockpicker-am-pm-block"),x="INPUT"===s.prop("tagName"),T=x?s:s.find("input"),_=c("label[for="+T.attr("id")+"]"),V=this;if(this.id=e("cp"),this.element=s,this.holder=m,this.options=n,this.isAppended=!1,this.isShown=!1,this.currentView="hours",this.isInput=x,this.input=T,this.label=_,this.popover=l,this.plate=h,this.hoursView=v,this.minutesView=P,this.amPmBlock=C,this.spanHours=l.find(".clockpicker-span-hours"),this.spanMinutes=l.find(".clockpicker-span-minutes"),this.spanAmPm=l.find(".clockpicker-span-am-pm"),this.footer=l.find(".picker__footer"),this.amOrPm="PM",n.twelvehour){var H=['<div class="clockpicker-am-pm-block">','<button type="button" class="btn-floating btn-flat clockpicker-button clockpicker-am-button">',"AM","</button>",'<button type="button" class="btn-floating btn-flat clockpicker-button clockpicker-pm-button">',"PM","</button>","</div>"].join("");c(H);n.ampmclickable?(this.spanAmPm.empty(),c('<div id="click-am">AM</div>').on("click",function(){V.spanAmPm.children("#click-am").addClass("text-primary"),V.spanAmPm.children("#click-pm").removeClass("text-primary"),V.amOrPm="AM"}).appendTo(this.spanAmPm),c('<div id="click-pm">PM</div>').on("click",function(){V.spanAmPm.children("#click-pm").addClass("text-primary"),V.spanAmPm.children("#click-am").removeClass("text-primary"),V.amOrPm="PM"}).appendTo(this.spanAmPm)):(c('<button type="button" class="btn-floating btn-flat clockpicker-button am-button" tabindex="1">AM</button>').on("click",function(){V.amOrPm="AM",V.amPmBlock.children(".pm-button").removeClass("active"),V.amPmBlock.children(".am-button").addClass("active"),V.spanAmPm.empty().append("AM")}).appendTo(this.amPmBlock),c('<button type="button" class="btn-floating btn-flat clockpicker-button pm-button" tabindex="2">PM</button>').on("click",function(){V.amOrPm="PM",V.amPmBlock.children(".am-button").removeClass("active"),V.amPmBlock.children(".pm-button").addClass("active"),V.spanAmPm.empty().append("PM")}).appendTo(this.amPmBlock))}T.attr("type","text"),n.darktheme&&l.addClass("darktheme"),c('<button type="button" class="btn-flat clockpicker-button" tabindex="'+(n.twelvehour?"3":"1")+'">'+n.donetext+"</button>").click(c.proxy(this.done,this)).appendTo(this.footer),this.spanHours.click(c.proxy(this.toggleView,this,"hours")),this.spanMinutes.click(c.proxy(this.toggleView,this,"minutes")),T.on("focus.clockpicker click.clockpicker",c.proxy(this.show,this));var S,B,D,E,I=c('<div class="clockpicker-tick"></div>');if(n.twelvehour)for(S=1;S<13;S+=1)B=I.clone(),D=S/6*Math.PI,E=b,B.css("font-size","140%"),B.css({left:f+Math.sin(D)*E-w,top:f-Math.cos(D)*E-w}),B.html(0===S?"00":S),v.append(B),B.on(u,r);else for(S=0;S<24;S+=1){B=I.clone(),D=S/6*Math.PI;var O=S>0&&S<13;E=O?g:b,B.css({left:f+Math.sin(D)*E-w,top:f-Math.cos(D)*E-w}),O&&B.css("font-size","120%"),B.html(0===S?"00":S),v.append(B),B.on(u,r)}for(S=0;S<60;S+=5)B=I.clone(),D=S/30*Math.PI,B.css({left:f+Math.sin(D)*b-w,top:f-Math.cos(D)*b-w}),B.css("font-size","140%"),B.html(i(S)),P.append(B),B.on(u,r);if(h.on(u,function(t){0===c(t.target).closest(".clockpicker-tick").length&&r(t,!0)}),p){var z=l.find(".clockpicker-canvas"),U=t("svg");U.setAttribute("class","clockpicker-svg"),U.setAttribute("width",y),U.setAttribute("height",y);var j=t("g");j.setAttribute("transform","translate("+f+","+f+")");var L=t("circle");L.setAttribute("class","clockpicker-canvas-bearing"),L.setAttribute("cx",0),L.setAttribute("cy",0),L.setAttribute("r",2);var N=t("line");N.setAttribute("x1",0),N.setAttribute("y1",0);var X=t("circle");X.setAttribute("class","clockpicker-canvas-bg"),X.setAttribute("r",w);var Y=t("circle");Y.setAttribute("class","clockpicker-canvas-fg"),Y.setAttribute("r",5),j.appendChild(N),j.appendChild(X),j.appendChild(Y),j.appendChild(L),U.appendChild(j),z.append(U),this.hand=N,this.bg=X,this.fg=Y,this.bearing=L,this.g=j,this.canvas=z}o(this.options.init)}function o(t){t&&"function"==typeof t&&t()}var c=window.jQuery,n=c(window),a=c(document),r="http://www.w3.org/2000/svg",p="SVGAngle"in window&&function(){var t,i=document.createElement("div");return i.innerHTML="<svg/>",t=(i.firstChild&&i.firstChild.namespaceURI)==r,i.innerHTML="",t}(),l=function(){var t=document.createElement("div").style;return"transition"in t||"WebkitTransition"in t||"MozTransition"in t||"msTransition"in t||"OTransition"in t}(),h="ontouchstart"in window,u="mousedown"+(h?" touchstart":""),d="mousemove.clockpicker"+(h?" touchmove.clockpicker":""),k="mouseup.clockpicker"+(h?" touchend.clockpicker":""),m=navigator.vibrate?"vibrate":navigator.webkitVibrate?"webkitVibrate":null,v=0,f=135,b=110,g=80,w=20,y=2*f,A=l?350:1,M=['<div class="clockpicker picker">','<div class="picker__holder">','<div class="picker__frame">','<div class="picker__wrap">','<div class="picker__box">','<div class="picker__date-display">','<div class="clockpicker-display">','<div class="clockpicker-display-column">','<span class="clockpicker-span-hours text-primary"></span>',":",'<span class="clockpicker-span-minutes"></span>',"</div>",'<div class="clockpicker-display-column clockpicker-display-am-pm">','<div class="clockpicker-span-am-pm"></div>',"</div>","</div>","</div>",'<div class="picker__calendar-container">','<div class="clockpicker-plate">','<div class="clockpicker-canvas"></div>','<div class="clockpicker-dial clockpicker-hours"></div>','<div class="clockpicker-dial clockpicker-minutes clockpicker-dial-out"></div>',"</div>",'<div class="clockpicker-am-pm-block">',"</div>","</div>",'<div class="picker__footer">',"</div>","</div>","</div>","</div>","</div>","</div>"].join("");s.DEFAULTS={"default":"",fromnow:0,donetext:"Done",autoclose:!1,ampmclickable:!1,darktheme:!1,twelvehour:!0,vibrate:!0},s.prototype.toggle=function(){this[this.isShown?"hide":"show"]()},s.prototype.locate=function(){var t=this.element,i=this.popover;t.offset(),t.outerWidth(),t.outerHeight(),this.options.align;i.show()},s.prototype.show=function(t){if(this.setAMorPM=function(t){var i=t,e="pm"==t?"am":"pm";this.options.twelvehour&&(this.amOrPm=i.toUpperCase(),this.options.ampmclickable?(this.spanAmPm.children("#click-"+i).addClass("text-primary"),this.spanAmPm.children("#click-"+e).removeClass("text-primary")):(this.amPmBlock.children("."+e+"-button").removeClass("active"),this.amPmBlock.children("."+i+"-button").addClass("active"),this.spanAmPm.empty().append(this.amOrPm)))},!this.isShown){o(this.options.beforeShow),c(":input").each(function(){c(this).attr("tabindex",-1)});var e=this;this.input.blur(),this.popover.addClass("picker--opened"),this.input.addClass("picker__input picker__input--active"),c(document.body).css("overflow","hidden"),this.isAppended||(this.options.hasOwnProperty("container")?this.popover.appendTo(this.options.container):this.popover.insertAfter(this.input),this.setAMorPM("pm"),n.on("resize.clockpicker"+this.id,function(){e.isShown&&e.locate()}),this.isAppended=!0);var s=((this.input.prop("value")||this.options["default"]||"")+"").split(":");if(this.options.twelvehour&&"undefined"!=typeof s[1]&&(s[1].includes("AM")?this.setAMorPM("am"):this.setAMorPM("pm"),s[1]=s[1].replace("AM","").replace("PM","")),"now"===s[0]){var r=new Date(+new Date+this.options.fromnow);r.getHours()>=12?this.setAMorPM("pm"):this.setAMorPM("am"),s=[r.getHours(),r.getMinutes()]}this.hours=+s[0]||0,this.minutes=+s[1]||0,this.spanHours.html(i(this.hours)),this.spanMinutes.html(i(this.minutes)),this.toggleView("hours"),this.locate(),this.isShown=!0,a.on("click.clockpicker."+this.id+" focusin.clockpicker."+this.id,function(t){var i=c(t.target);0===i.closest(e.popover.find(".picker__wrap")).length&&0===i.closest(e.input).length&&e.hide()}),a.on("keyup.clockpicker."+this.id,function(t){27===t.keyCode&&e.hide()}),o(this.options.afterShow)}},s.prototype.hide=function(){o(this.options.beforeHide),this.input.removeClass("picker__input picker__input--active"),this.popover.removeClass("picker--opened"),c(document.body).css("overflow","visible"),this.isShown=!1,c(":input").each(function(t){c(this).attr("tabindex",t+1)}),a.off("click.clockpicker."+this.id+" focusin.clockpicker."+this.id),a.off("keyup.clockpicker."+this.id),this.popover.hide(),o(this.options.afterHide)},s.prototype.toggleView=function(t,i){var e=!1;"minutes"===t&&"visible"===c(this.hoursView).css("visibility")&&(o(this.options.beforeHourSelect),e=!0);var s="hours"===t,n=s?this.hoursView:this.minutesView,a=s?this.minutesView:this.hoursView;this.currentView=t,this.spanHours.toggleClass("text-primary",s),this.spanMinutes.toggleClass("text-primary",!s),a.addClass("clockpicker-dial-out"),n.css("visibility","visible").removeClass("clockpicker-dial-out"),this.resetClock(i),clearTimeout(this.toggleViewTimer),this.toggleViewTimer=setTimeout(function(){a.css("visibility","hidden")},A),e&&o(this.options.afterHourSelect)},s.prototype.resetClock=function(t){var i=this.currentView,e=this[i],s="hours"===i,o=Math.PI/(s?6:30),c=e*o,n=s&&e>0&&e<13?g:b,a=Math.sin(c)*n,r=-Math.cos(c)*n,l=this;p&&t?(l.canvas.addClass("clockpicker-canvas-out"),setTimeout(function(){l.canvas.removeClass("clockpicker-canvas-out"),l.setHand(a,r)},t)):this.setHand(a,r)},s.prototype.setHand=function(t,e,s,o){var n,a=Math.atan2(t,-e),r="hours"===this.currentView,l=Math.PI/(r||s?6:30),h=Math.sqrt(t*t+e*e),u=this.options,d=r&&h<(b+g)/2,k=d?g:b;if(u.twelvehour&&(k=b),a<0&&(a=2*Math.PI+a),n=Math.round(a/l),a=n*l,u.twelvehour?r?0===n&&(n=12):(s&&(n*=5),60===n&&(n=0)):r?(12===n&&(n=0),n=d?0===n?12:n:0===n?0:n+12):(s&&(n*=5),60===n&&(n=0)),r?this.fg.setAttribute("class","clockpicker-canvas-fg"):n%5==0?this.fg.setAttribute("class","clockpicker-canvas-fg"):this.fg.setAttribute("class","clockpicker-canvas-fg active"),this[this.currentView]!==n&&m&&this.options.vibrate&&(this.vibrateTimer||(navigator[m](10),this.vibrateTimer=setTimeout(c.proxy(function(){this.vibrateTimer=null},this),100))),this[this.currentView]=n,this[r?"spanHours":"spanMinutes"].html(i(n)),!p)return void this[r?"hoursView":"minutesView"].find(".clockpicker-tick").each(function(){var t=c(this);t.toggleClass("active",n===+t.html())});o||!r&&n%5?(this.g.insertBefore(this.hand,this.bearing),this.g.insertBefore(this.bg,this.fg),this.bg.setAttribute("class","clockpicker-canvas-bg clockpicker-canvas-bg-trans")):(this.g.insertBefore(this.hand,this.bg),this.g.insertBefore(this.fg,this.bg),this.bg.setAttribute("class","clockpicker-canvas-bg"));var v=Math.sin(a)*(k-w),f=-Math.cos(a)*(k-w),y=Math.sin(a)*k,A=-Math.cos(a)*k;this.hand.setAttribute("x2",v),this.hand.setAttribute("y2",f),this.bg.setAttribute("cx",y),this.bg.setAttribute("cy",A),this.fg.setAttribute("cx",y),this.fg.setAttribute("cy",A)},s.prototype.done=function(){o(this.options.beforeDone),this.hide(),this.label.addClass("active");var t=this.input.prop("value"),e=i(this.hours)+":"+i(this.minutes);this.options.twelvehour&&(e+=this.amOrPm),this.input.prop("value",e),e!==t&&(this.input.triggerHandler("change"),this.isInput||this.element.trigger("change")),this.options.autoclose&&this.input.trigger("blur"),o(this.options.afterDone)},s.prototype.remove=function(){this.element.removeData("clockpicker"),this.input.off("focus.clockpicker click.clockpicker"),this.isShown&&this.hide(),this.isAppended&&(n.off("resize.clockpicker"+this.id),this.popover.remove())},c.fn.pickatime=function(t){var i=Array.prototype.slice.call(arguments,1);return this.each(function(){var e=c(this),o=e.data("clockpicker");if(o)"function"==typeof o[t]&&o[t].apply(o,i);else{var n=c.extend({},s.DEFAULTS,e.data(),"object"==typeof t&&t);e.data("clockpicker",new s(e,n))}})}}();

/*!
 * ClockPicker v0.0.7 (http://weareoutman.github.io/clockpicker/)
 * Copyright 2014 Wang Shenwei.
 * Licensed under MIT (https://github.com/weareoutman/clockpicker/blob/gh-pages/LICENSE)
 *
 * Further modified
 * Copyright 2015 Ching Yaw Hao.
 */

;(function(){
    var $ = window.jQuery,
        $win = $(window),
        $doc = $(document);

    // Can I use inline svg ?
    var svgNS = 'http://www.w3.org/2000/svg',
        svgSupported = 'SVGAngle' in window && (function() {
                var supported,
                    el = document.createElement('div');
                el.innerHTML = '<svg/>';
                supported = (el.firstChild && el.firstChild.namespaceURI) == svgNS;
                el.innerHTML = '';
                return supported;
            })();

    // Can I use transition ?
    var transitionSupported = (function() {
        var style = document.createElement('div').style;
        return 'transition' in style ||
            'WebkitTransition' in style ||
            'MozTransition' in style ||
            'msTransition' in style ||
            'OTransition' in style;
    })();

    // Listen touch events in touch screen device, instead of mouse events in desktop.
    var touchSupported = 'ontouchstart' in window,
        mousedownEvent = 'mousedown' + ( touchSupported ? ' touchstart' : ''),
        mousemoveEvent = 'mousemove.clockpicker' + ( touchSupported ? ' touchmove.clockpicker' : ''),
        mouseupEvent = 'mouseup.clockpicker' + ( touchSupported ? ' touchend.clockpicker' : '');

    // Vibrate the device if supported
    var vibrate = navigator.vibrate ? 'vibrate' : navigator.webkitVibrate ? 'webkitVibrate' : null;

    function createSvgElement(name) {
        return document.createElementNS(svgNS, name);
    }

    function leadingZero(num) {
        return (num < 10 ? '0' : '') + num;
    }

    // Get a unique id
    var idCounter = 0;
    function uniqueId(prefix) {
        var id = ++idCounter + '';
        return prefix ? prefix + id : id;
    }

    // Clock size
    var dialRadius = 135,
        outerRadius = 110,
    // innerRadius = 80 on 12 hour clock
        innerRadius = 80,
        tickRadius = 20,
        diameter = dialRadius * 2,
        duration = transitionSupported ? 350 : 1;

    // Popover template
    var tpl = [
        '<div class="clockpicker picker">',
        '<div class="picker__holder">',
        '<div class="picker__frame">',
        '<div class="picker__wrap">',
        '<div class="picker__box">',
        '<div class="picker__date-display">',
        '<div class="clockpicker-display">',
        '<div class="clockpicker-display-column">',
        '<span class="clockpicker-span-hours text-primary"></span>',
        ':',
        '<span class="clockpicker-span-minutes"></span>',
        '</div>',
        '<div class="clockpicker-display-column clockpicker-display-am-pm">',
        '<div class="clockpicker-span-am-pm"></div>',
        '</div>',
        '</div>',
        '</div>',
        '<div class="picker__calendar-container">',
        '<div class="clockpicker-plate">',
        '<div class="clockpicker-canvas"></div>',
        '<div class="clockpicker-dial clockpicker-hours"></div>',
        '<div class="clockpicker-dial clockpicker-minutes clockpicker-dial-out"></div>',
        '</div>',
        '<div class="clockpicker-am-pm-block">',
        '</div>',
        '</div>',
        '<div class="picker__footer">',
        '</div>',
        '</div>',
        '</div>',
        '</div>',
        '</div>',
        '</div>'
    ].join('');

    // ClockPicker
    function ClockPicker(element, options) {
        var popover = $(tpl),
            plate = popover.find('.clockpicker-plate'),
            holder = popover.find('.picker__holder'),
            hoursView = popover.find('.clockpicker-hours'),
            minutesView = popover.find('.clockpicker-minutes'),
            amPmBlock = popover.find('.clockpicker-am-pm-block'),
            isInput = element.prop('tagName') === 'INPUT',
            input = isInput ? element : element.find('input'),
            label = $("label[for=" + input.attr("id") + "]"),
            self = this,
            timer;

        this.id = uniqueId('cp');
        this.element = element;
        this.holder = holder;
        this.options = options;
        this.isAppended = false;
        this.isShown = false;
        this.currentView = 'hours';
        this.isInput = isInput;
        this.input = input;
        this.label = label;
        this.popover = popover;
        this.plate = plate;
        this.hoursView = hoursView;
        this.minutesView = minutesView;
        this.amPmBlock = amPmBlock;
        this.spanHours = popover.find('.clockpicker-span-hours');
        this.spanMinutes = popover.find('.clockpicker-span-minutes');
        this.spanAmPm = popover.find('.clockpicker-span-am-pm');
        this.footer = popover.find('.picker__footer');
        this.amOrPm = "PM";

        // Setup for for 12 hour clock if option is selected
        if (options.twelvehour) {
            var  amPmButtonsTemplate = [
                '<div class="clockpicker-am-pm-block">',
                '<button type="button" class="btn-floating btn-flat clockpicker-button clockpicker-am-button">',
                'AM',
                '</button>',
                '<button type="button" class="btn-floating btn-flat clockpicker-button clockpicker-pm-button">',
                'PM',
                '</button>',
                '</div>'
            ].join('');

            var amPmButtons = $(amPmButtonsTemplate);

            if(!options.ampmclickable) {
                $('<button type="button" class="btn-floating btn-flat clockpicker-button am-button" tabindex="1">' + "AM" + '</button>').on("click", function() {
                    self.amOrPm = "AM";
                    self.amPmBlock.children('.pm-button').removeClass('active');
                    self.amPmBlock.children('.am-button').addClass('active');
                    self.spanAmPm.empty().append('AM');
                }).appendTo(this.amPmBlock);
                $('<button type="button" class="btn-floating btn-flat clockpicker-button pm-button" tabindex="2">' + "PM" + '</button>').on("click", function() {
                    self.amOrPm = 'PM';
                    self.amPmBlock.children('.am-button').removeClass('active');
                    self.amPmBlock.children('.pm-button').addClass('active');
                    self.spanAmPm.empty().append('PM');
                }).appendTo(this.amPmBlock);
            }
            else {
                this.spanAmPm.empty();
                $('<div id="click-am">AM</div>').on("click", function() {
                    self.spanAmPm.children('#click-am').addClass("text-primary");
                    self.spanAmPm.children('#click-pm').removeClass("text-primary");
                    self.amOrPm = "AM";
                }).appendTo(this.spanAmPm);
                $('<div id="click-pm">PM</div>').on("click", function() {
                    self.spanAmPm.children('#click-pm').addClass("text-primary");
                    self.spanAmPm.children('#click-am').removeClass("text-primary");
                    self.amOrPm = 'PM';
                }).appendTo(this.spanAmPm);
            }
        }
        //force input to type ( disable type=time )
        input.attr('type','text');

        //convertir el dato por defecto y agregarlo al input
        var value = ((this.options['default'] || this.input.prop('value') || 'now') + '').split(':'),
            submit = ((this.options['default'] || this.input.prop('value') || 'now') + '').split(':');

        if(this.options.twelvehour && !(typeof value[1] === 'undefined')) {
            var hour = parseInt(value[0]);
            value[0] = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12) : hour);
            value[1] = value[1] + ((hour < 12) ? 'AM' : 'PM');
        }
        //en caso que no se haya especificado un valor por defecto,
        //el input se deja vacio pero el reloj se carga con la hora del sistema
        if (value[0] === 'now') {
            var now = new Date(+ new Date() + this.options.fromnow);
            this.options.default = 'now';
            submit = [ leadingZero(now.getHours()), leadingZero(now.getMinutes()), '00' ];
            input.prop({
                default:submit.join(':')
            }).data({
                default:submit.join(':'),
                submit:submit.join(':')
            }).attr({
                'data-default':submit.join(':'),
                'data-submit':submit.join(':')
            });
        } else {
            input.prop({value:(value[0] +':'+ value[1])})
                .data({submit:submit.join(':')})
                .attr({
                    value:(value[0] +':'+ value[1]),
                    'data-submit':submit.join(':')
                });
        }
        if(options.darktheme)
            popover.addClass('darktheme');

        // If autoclose is not setted, append a button
        $('<button type="button" class="btn-flat clockpicker-button" tabindex="' + (options.twelvehour? '3' : '1') + '">' + options.donetext + '</button>').click($.proxy(this.done, this)).appendTo(this.footer);

        this.spanHours.click($.proxy(this.toggleView, this, 'hours'));
        this.spanMinutes.click($.proxy(this.toggleView, this, 'minutes'));

        // Show or toggle
        input.on('focus.clockpicker click.clockpicker', $.proxy(this.show, this));

        // Build ticks
        var tickTpl = $('<div class="clockpicker-tick"></div>'),
            i, tick, radian, radius;

        // Hours view
        if (options.twelvehour) {
            for (i = 1; i < 13; i += 1) {
                tick = tickTpl.clone();
                radian = i / 6 * Math.PI;
                radius = outerRadius;
                tick.css('font-size', '140%');
                tick.css({
                    left: dialRadius + Math.sin(radian) * radius - tickRadius,
                    top: dialRadius - Math.cos(radian) * radius - tickRadius
                });
                tick.html(i === 0 ? '00' : i);
                hoursView.append(tick);
                tick.on(mousedownEvent, mousedown);
            }
        } else {
            for (i = 0; i < 24; i += 1) {
                tick = tickTpl.clone();
                radian = i / 6 * Math.PI;
                var inner = i > 0 && i < 13;
                radius = inner ? innerRadius : outerRadius;
                tick.css({
                    left: dialRadius + Math.sin(radian) * radius - tickRadius,
                    top: dialRadius - Math.cos(radian) * radius - tickRadius
                });
                if (inner)
                    tick.css('font-size', '120%');
                tick.html(i === 0 ? '00' : i);
                hoursView.append(tick);
                tick.on(mousedownEvent, mousedown);
            }
        }

        // Minutes view
        for (i = 0; i < 60; i += 5) {
            tick = tickTpl.clone();
            radian = i / 30 * Math.PI;
            tick.css({
                left: dialRadius + Math.sin(radian) * outerRadius - tickRadius,
                top: dialRadius - Math.cos(radian) * outerRadius - tickRadius
            });
            tick.css('font-size', '140%');
            tick.html(leadingZero(i));
            minutesView.append(tick);
            tick.on(mousedownEvent, mousedown);
        }

        // Clicking on minutes view space
        plate.on(mousedownEvent, function(e) {
            if ($(e.target).closest('.clockpicker-tick').length === 0)
                mousedown(e, true);
        });

        // Mousedown or touchstart
        function mousedown(e, space) {
            var offset = plate.offset(),
                isTouch = /^touch/.test(e.type),
                x0 = offset.left + dialRadius,
                y0 = offset.top + dialRadius,
                dx = (isTouch ? e.originalEvent.touches[0] : e).pageX - x0,
                dy = (isTouch ? e.originalEvent.touches[0] : e).pageY - y0,
                z = Math.sqrt(dx * dx + dy * dy),
                moved = false;

            // When clicking on minutes view space, check the mouse position
            if (space && (z < outerRadius - tickRadius || z > outerRadius + tickRadius))
                return;
            e.preventDefault();

            // Set cursor style of body after 200ms
            var movingTimer = setTimeout(function(){
                self.popover.addClass('clockpicker-moving');
            }, 200);

            // Place the canvas to top
            if (svgSupported)
                plate.append(self.canvas);

            // Clock
            self.setHand(dx, dy, !space, true);

            // Mousemove on document
            $doc.off(mousemoveEvent).on(mousemoveEvent, function(e){
                e.preventDefault();
                var isTouch = /^touch/.test(e.type),
                    x = (isTouch ? e.originalEvent.touches[0] : e).pageX - x0,
                    y = (isTouch ? e.originalEvent.touches[0] : e).pageY - y0;
                if (! moved && x === dx && y === dy)
                // Clicking in chrome on windows will trigger a mousemove event
                    return;
                moved = true;
                self.setHand(x, y, false, true);
            });

            // Mouseup on document
            $doc.off(mouseupEvent).on(mouseupEvent, function(e) {
                $doc.off(mouseupEvent);
                e.preventDefault();
                var isTouch = /^touch/.test(e.type),
                    x = (isTouch ? e.originalEvent.changedTouches[0] : e).pageX - x0,
                    y = (isTouch ? e.originalEvent.changedTouches[0] : e).pageY - y0;
                if ((space || moved) && x === dx && y === dy)
                    self.setHand(x, y);
                if (self.currentView === 'hours')
                    self.toggleView('minutes', duration / 2);
                else
                if (options.autoclose) {
                    self.minutesView.addClass('clockpicker-dial-out');
                    setTimeout(function(){
                        self.done();
                    }, duration / 2);
                }
                plate.prepend(canvas);

                // Reset cursor style of body
                clearTimeout(movingTimer);
                self.popover.removeClass('clockpicker-moving');

                // Unbind mousemove event
                $doc.off(mousemoveEvent);
            });
        }

        if (svgSupported) {
            // Draw clock hands and others
            var canvas = popover.find('.clockpicker-canvas'),
                svg = createSvgElement('svg');
            svg.setAttribute('class', 'clockpicker-svg');
            svg.setAttribute('width', diameter);
            svg.setAttribute('height', diameter);
            var g = createSvgElement('g');
            g.setAttribute('transform', 'translate(' + dialRadius + ',' + dialRadius + ')');
            var bearing = createSvgElement('circle');
            bearing.setAttribute('class', 'clockpicker-canvas-bearing');
            bearing.setAttribute('cx', 0);
            bearing.setAttribute('cy', 0);
            bearing.setAttribute('r', 2);
            var hand = createSvgElement('line');
            hand.setAttribute('x1', 0);
            hand.setAttribute('y1', 0);
            var bg = createSvgElement('circle');
            bg.setAttribute('class', 'clockpicker-canvas-bg');
            bg.setAttribute('r', tickRadius);
            var fg = createSvgElement('circle');
            fg.setAttribute('class', 'clockpicker-canvas-fg');
            fg.setAttribute('r', 5);
            g.appendChild(hand);
            g.appendChild(bg);
            g.appendChild(fg);
            g.appendChild(bearing);
            svg.appendChild(g);
            canvas.append(svg);

            this.hand = hand;
            this.bg = bg;
            this.fg = fg;
            this.bearing = bearing;
            this.g = g;
            this.canvas = canvas;
        }

        raiseCallback(this.options.init);
    }

    function raiseCallback(callbackFunction) {
        if(callbackFunction && typeof callbackFunction === "function")
            callbackFunction();
    }

    // Default options
    ClockPicker.DEFAULTS = {
        'default': '',         // default time, 'now' or '13:14' e.g.
        fromnow: 0,            // set default time to * milliseconds from now (using with default = 'now')
        donetext: 'Done',      // done button text
        autoclose: false,      // auto close when minute is selected
        ampmclickable: false,  // set am/pm button on itself
        darktheme: false,		// set to dark theme
        twelvehour: true,      	// change to 12 hour AM/PM clock from 24 hour
        vibrate: true,          // vibrate the device when dragging clock hand
        submit: '' 				// guarda el valor time en 24 horas
    };

    // Show or hide popover
    ClockPicker.prototype.toggle = function() {
        this[this.isShown ? 'hide' : 'show']();
    };

    // Set popover position
    ClockPicker.prototype.locate = function() {
        var element = this.element,
            popover = this.popover,
            offset = element.offset(),
            width = element.outerWidth(),
            height = element.outerHeight(),
            align = this.options.align,
            self = this;

        popover.show();
    };
    // Show popover
    ClockPicker.prototype.show = function(e){
        this.setAMorPM = function(option) {
            var active = option;
            var inactive = (option == "pm"? "am":"pm");
            if(this.options.twelvehour) {
                this.amOrPm = active.toUpperCase();
                if(!this.options.ampmclickable) {
                    this.amPmBlock.children('.' + inactive + '-button').removeClass('active');
                    this.amPmBlock.children('.' + active + '-button').addClass('active');
                    this.spanAmPm.empty().append(this.amOrPm);
                }
                else {
                    this.spanAmPm.children('#click-' + active + '').addClass("text-primary");
                    this.spanAmPm.children('#click-' + inactive + '').removeClass("text-primary");
                }
            }
        }
        // Not show again
        if (this.isShown) {
            return;
        }
        raiseCallback(this.options.beforeShow);
        $(':input').each(function() {
            $(this).attr('tabindex', -1);
        })
        var self = this;
        // Initialize
        this.input.blur();
        this.popover.addClass('picker--opened');
        this.input.addClass('picker__input picker__input--active');
        $(document.body).css('overflow', 'hidden');
        if (!this.isAppended) {
            // Append popover to options.container
            if(this.options.hasOwnProperty('container'))
                this.popover.appendTo(this.options.container);
            else
                this.popover.insertAfter(this.input);
            this.setAMorPM("pm");
            // Reset position when resize
            $win.on('resize.clockpicker' + this.id, function() {
                if (self.isShown) {
                    self.locate();
                }
            });
            this.isAppended = true;
        }
        // Get the time
        var value = ((this.options['default'] || this.input.prop('value') || 'now') + '').split(':');
        if(this.options.twelvehour && !(typeof value[1] === 'undefined')) {
            if(value[1].includes('AM'))
                this.setAMorPM("am");
            else
                this.setAMorPM("pm");
            value[1] = value[1].replace("AM", "").replace("PM", "");
        }
        if (value[0] === 'now') {
            var now = new Date(+ new Date() + this.options.fromnow);
            if (now.getHours() >= 12 || parseInt(value[0]) < 12 )
                this.setAMorPM("pm");
            else
                this.setAMorPM("am");
            value = [
                now.getHours(),
                now.getMinutes()
            ];
        }
        this.hours = + value[0] || 0;
        this.minutes = + value[1] || 0;
        this.spanHours.html(leadingZero(this.hours));
        this.spanMinutes.html(leadingZero(this.minutes));
        // Toggle to hours view
        this.toggleView('hours');
        // Set position
        this.locate();
        this.isShown = true;
        // Hide when clicking or tabbing on any element except the clock and input
        $doc.on('click.clockpicker.' + this.id + ' focusin.clockpicker.' + this.id, function(e) {
            var target = $(e.target);
            if (target.closest(self.popover.find('.picker__wrap')).length === 0 && target.closest(self.input).length === 0)
                self.hide();
        });
        // Hide when ESC is pressed
        $doc.on('keyup.clockpicker.' + this.id, function(e){
            if (e.keyCode === 27)
                self.hide();
        });
        raiseCallback(this.options.afterShow);
    };
    // Hide popover
    ClockPicker.prototype.hide = function() {
        raiseCallback(this.options.beforeHide);
        this.input.removeClass('picker__input picker__input--active');
        this.popover.removeClass('picker--opened');
        $(document.body).css('overflow', 'visible');
        this.isShown = false;
        $(':input').each(function(index) {
            $(this).attr('tabindex', index + 1);
        });
        // Unbinding events on document
        $doc.off('click.clockpicker.' + this.id + ' focusin.clockpicker.' + this.id);
        $doc.off('keyup.clockpicker.' + this.id);
        this.popover.hide();
        raiseCallback(this.options.afterHide);
    };
    // Toggle to hours or minutes view
    ClockPicker.prototype.toggleView = function(view, delay) {
        var raiseAfterHourSelect = false;
        if (view === 'minutes' && $(this.hoursView).css("visibility") === "visible") {
            raiseCallback(this.options.beforeHourSelect);
            raiseAfterHourSelect = true;
        }
        var isHours = view === 'hours',
            nextView = isHours ? this.hoursView : this.minutesView,
            hideView = isHours ? this.minutesView : this.hoursView;
        this.currentView = view;

        this.spanHours.toggleClass('text-primary', isHours);
        this.spanMinutes.toggleClass('text-primary', ! isHours);

        // Let's make transitions
        hideView.addClass('clockpicker-dial-out');
        nextView.css('visibility', 'visible').removeClass('clockpicker-dial-out');

        // Reset clock hand
        this.resetClock(delay);

        // After transitions ended
        clearTimeout(this.toggleViewTimer);
        this.toggleViewTimer = setTimeout(function() {
            hideView.css('visibility', 'hidden');
        }, duration);

        if (raiseAfterHourSelect)
            raiseCallback(this.options.afterHourSelect);
    };

    // Reset clock hand
    ClockPicker.prototype.resetClock = function(delay) {
        var view = this.currentView,
            value = this[view],
            isHours = view === 'hours',
            unit = Math.PI / (isHours ? 6 : 30),
            radian = value * unit,
            radius = isHours && value > 0 && value < 13 ? innerRadius : outerRadius,
            x = Math.sin(radian) * radius,
            y = - Math.cos(radian) * radius,
            self = this;

        if(svgSupported && delay) {
            self.canvas.addClass('clockpicker-canvas-out');
            setTimeout(function(){
                self.canvas.removeClass('clockpicker-canvas-out');
                self.setHand(x, y);
            }, delay);
        } else
            this.setHand(x, y);
    };

    // Set clock hand to (x, y)
    ClockPicker.prototype.setHand = function(x, y, roundBy5, dragging) {
        var radian = Math.atan2(x, - y),
            isHours = this.currentView === 'hours',
            unit = Math.PI / (isHours || roundBy5? 6 : 30),
            z = Math.sqrt(x * x + y * y),
            options = this.options,
            inner = isHours && z < (outerRadius + innerRadius) / 2,
            radius = inner ? innerRadius : outerRadius,
            value;

        if (options.twelvehour)
            radius = outerRadius;

        // Radian should in range [0, 2PI]
        if (radian < 0)
            radian = Math.PI * 2 + radian;

        // Get the round value
        value = Math.round(radian / unit);

        // Get the round radian
        radian = value * unit;

        // Correct the hours or minutes
        if(options.twelvehour) {
            if(isHours) {
                if(value === 0)
                    value = 12;
            } else {
                if(roundBy5)
                    value *= 5;
                if(value === 60)
                    value = 0;
            }
        } else {
            if(isHours) {
                if(value === 12)
                    value = 0;
                value = inner ? (value === 0 ? 12 : value) : value === 0 ? 0 : value + 12;
            } else {
                if(roundBy5)
                    value *= 5;
                if(value === 60)
                    value = 0;
            }
        }
        if (isHours)
            this.fg.setAttribute('class', 'clockpicker-canvas-fg');
        else {
            if(value % 5 == 0)
                this.fg.setAttribute('class', 'clockpicker-canvas-fg');
            else
                this.fg.setAttribute('class', 'clockpicker-canvas-fg active');
        }

        // Once hours or minutes changed, vibrate the device
        if (this[this.currentView] !== value)
            if (vibrate && this.options.vibrate)
            // Do not vibrate too frequently
                if (! this.vibrateTimer) {
                    navigator[vibrate](10);
                    this.vibrateTimer = setTimeout($.proxy(function(){
                        this.vibrateTimer = null;
                    }, this), 100);
                }

        this[this.currentView] = value;
        this[isHours ? 'spanHours' : 'spanMinutes'].html(leadingZero(value));

        // If svg is not supported, just add an active class to the tick
        if (! svgSupported) {
            this[isHours ? 'hoursView' : 'minutesView'].find('.clockpicker-tick').each(function(){
                var tick = $(this);
                tick.toggleClass('active', value === + tick.html());
            });
            return;
        }

        // Place clock hand at the top when dragging
        if (dragging || (! isHours && value % 5)) {
            this.g.insertBefore(this.hand, this.bearing);
            this.g.insertBefore(this.bg, this.fg);
            this.bg.setAttribute('class', 'clockpicker-canvas-bg clockpicker-canvas-bg-trans');
        } else {
            // Or place it at the bottom
            this.g.insertBefore(this.hand, this.bg);
            this.g.insertBefore(this.fg, this.bg);
            this.bg.setAttribute('class', 'clockpicker-canvas-bg');
        }

        // Set clock hand and others' position
        var cx1 = Math.sin(radian) * (radius - tickRadius),
            cy1 = - Math.cos(radian) * (radius - tickRadius),
            cx2 = Math.sin(radian) * radius,
            cy2 = - Math.cos(radian) * radius;
        this.hand.setAttribute('x2', cx1);
        this.hand.setAttribute('y2', cy1);
        this.bg.setAttribute('cx', cx2);
        this.bg.setAttribute('cy', cy2);
        this.fg.setAttribute('cx', cx2);
        this.fg.setAttribute('cy', cy2);
    };

    // Hours and minutes are selected
    ClockPicker.prototype.done = function() {
        raiseCallback(this.options.beforeDone);
        this.hide();
        this.label.addClass('active');

        var last = this.input.prop('value') || this.input.attr('value'),
            value = leadingZero(this.hours) + ':' + leadingZero(this.minutes);
        submit = leadingZero(this.hours) + ':' + leadingZero(this.minutes) + ':00';

        if (this.options.twelvehour) {
            value = value + this.amOrPm;
            if ( this.amOrPm == 'PM' ) {
                submit = ((this.hours > 12) ? (this.hours + 12) : '00') + ':' + leadingZero(this.minutes) + ':00';
                console.log(this.hours, this.minutes, this.amOrPm);
            }
        }
        /*!
         * ClockPicker v0.0.7 (http://weareoutman.github.io/clockpicker/)
         * Copyright 2014 Wang Shenwei.
         * Licensed under MIT (https://github.com/weareoutman/clockpicker/blob/gh-pages/LICENSE)
         *
         * Further modified
         * Copyright 2015 Ching Yaw Hao.
         */

        ;(function(){
            var $ = window.jQuery,
                $win = $(window),
                $doc = $(document);

            // Can I use inline svg ?
            var svgNS = 'http://www.w3.org/2000/svg',
                svgSupported = 'SVGAngle' in window && (function() {
                        var supported,
                            el = document.createElement('div');
                        el.innerHTML = '<svg/>';
                        supported = (el.firstChild && el.firstChild.namespaceURI) == svgNS;
                        el.innerHTML = '';
                        return supported;
                    })();

            // Can I use transition ?
            var transitionSupported = (function() {
                var style = document.createElement('div').style;
                return 'transition' in style ||
                    'WebkitTransition' in style ||
                    'MozTransition' in style ||
                    'msTransition' in style ||
                    'OTransition' in style;
            })();

            // Listen touch events in touch screen device, instead of mouse events in desktop.
            var touchSupported = 'ontouchstart' in window,
                mousedownEvent = 'mousedown' + ( touchSupported ? ' touchstart' : ''),
                mousemoveEvent = 'mousemove.clockpicker' + ( touchSupported ? ' touchmove.clockpicker' : ''),
                mouseupEvent = 'mouseup.clockpicker' + ( touchSupported ? ' touchend.clockpicker' : '');

            // Vibrate the device if supported
            var vibrate = navigator.vibrate ? 'vibrate' : navigator.webkitVibrate ? 'webkitVibrate' : null;

            function createSvgElement(name) {
                return document.createElementNS(svgNS, name);
            }

            function leadingZero(num) {
                return (num < 10 ? '0' : '') + num;
            }

            // Get a unique id
            var idCounter = 0;
            function uniqueId(prefix) {
                var id = ++idCounter + '';
                return prefix ? prefix + id : id;
            }

            // Clock size
            var dialRadius = 135,
                outerRadius = 110,
            // innerRadius = 80 on 12 hour clock
                innerRadius = 80,
                tickRadius = 20,
                diameter = dialRadius * 2,
                duration = transitionSupported ? 350 : 1;

            // Popover template
            var tpl = [
                '<div class="clockpicker picker">',
                '<div class="picker__holder">',
                '<div class="picker__frame">',
                '<div class="picker__wrap">',
                '<div class="picker__box">',
                '<div class="picker__date-display">',
                '<div class="clockpicker-display">',
                '<div class="clockpicker-display-column">',
                '<span class="clockpicker-span-hours text-primary"></span>',
                ':',
                '<span class="clockpicker-span-minutes"></span>',
                '</div>',
                '<div class="clockpicker-display-column clockpicker-display-am-pm">',
                '<div class="clockpicker-span-am-pm"></div>',
                '</div>',
                '</div>',
                '</div>',
                '<div class="picker__calendar-container">',
                '<div class="clockpicker-plate">',
                '<div class="clockpicker-canvas"></div>',
                '<div class="clockpicker-dial clockpicker-hours"></div>',
                '<div class="clockpicker-dial clockpicker-minutes clockpicker-dial-out"></div>',
                '</div>',
                '<div class="clockpicker-am-pm-block">',
                '</div>',
                '</div>',
                '<div class="picker__footer">',
                '</div>',
                '</div>',
                '</div>',
                '</div>',
                '</div>',
                '</div>'
            ].join('');

            // ClockPicker
            function ClockPicker(element, options) {
                var popover = $(tpl),
                    plate = popover.find('.clockpicker-plate'),
                    holder = popover.find('.picker__holder'),
                    hoursView = popover.find('.clockpicker-hours'),
                    minutesView = popover.find('.clockpicker-minutes'),
                    amPmBlock = popover.find('.clockpicker-am-pm-block'),
                    isInput = element.prop('tagName') === 'INPUT',
                    input = isInput ? element : element.find('input'),
                    label = $("label[for=" + input.attr("id") + "]"),
                    self = this,
                    timer;

                this.id = uniqueId('cp');
                this.element = element;
                this.holder = holder;
                this.options = options;
                this.isAppended = false;
                this.isShown = false;
                this.currentView = 'hours';
                this.isInput = isInput;
                this.input = input;
                this.label = label;
                this.popover = popover;
                this.plate = plate;
                this.hoursView = hoursView;
                this.minutesView = minutesView;
                this.amPmBlock = amPmBlock;
                this.spanHours = popover.find('.clockpicker-span-hours');
                this.spanMinutes = popover.find('.clockpicker-span-minutes');
                this.spanAmPm = popover.find('.clockpicker-span-am-pm');
                this.footer = popover.find('.picker__footer');
                this.amOrPm = "PM";

                // Setup for for 12 hour clock if option is selected
                if (options.twelvehour) {
                    var  amPmButtonsTemplate = [
                        '<div class="clockpicker-am-pm-block">',
                        '<button type="button" class="btn-floating btn-flat clockpicker-button clockpicker-am-button">',
                        'AM',
                        '</button>',
                        '<button type="button" class="btn-floating btn-flat clockpicker-button clockpicker-pm-button">',
                        'PM',
                        '</button>',
                        '</div>'
                    ].join('');

                    var amPmButtons = $(amPmButtonsTemplate);

                    if(!options.ampmclickable) {
                        $('<button type="button" class="btn-floating btn-flat clockpicker-button am-button" tabindex="1">' + "AM" + '</button>').on("click", function() {
                            self.amOrPm = "AM";
                            self.amPmBlock.children('.pm-button').removeClass('active');
                            self.amPmBlock.children('.am-button').addClass('active');
                            self.spanAmPm.empty().append('AM');
                        }).appendTo(this.amPmBlock);
                        $('<button type="button" class="btn-floating btn-flat clockpicker-button pm-button" tabindex="2">' + "PM" + '</button>').on("click", function() {
                            self.amOrPm = 'PM';
                            self.amPmBlock.children('.am-button').removeClass('active');
                            self.amPmBlock.children('.pm-button').addClass('active');
                            self.spanAmPm.empty().append('PM');
                        }).appendTo(this.amPmBlock);
                    }
                    else {
                        this.spanAmPm.empty();
                        $('<div id="click-am">AM</div>').on("click", function() {
                            self.spanAmPm.children('#click-am').addClass("text-primary");
                            self.spanAmPm.children('#click-pm').removeClass("text-primary");
                            self.amOrPm = "AM";
                        }).appendTo(this.spanAmPm);
                        $('<div id="click-pm">PM</div>').on("click", function() {
                            self.spanAmPm.children('#click-pm').addClass("text-primary");
                            self.spanAmPm.children('#click-am').removeClass("text-primary");
                            self.amOrPm = 'PM';
                        }).appendTo(this.spanAmPm);
                    }
                }
                //force input to type ( disable type=time )
                input.attr('type','text');

                // PERSONALIZADO
                var value = ((this.options['default'] || this.input.prop('value') || 'now') + '').split(':'),
                    submit = ((this.options['default'] || this.input.prop('value') || 'now') + '').split(':');

                if(this.options.twelvehour && !(typeof value[1] === 'undefined')) {
                    var hour = parseInt(value[0]);
                    value[0] = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12) : hour);
                    value[1] = value[1] + ((hour < 12) ? 'AM' : 'PM');
                }

                if (value[0] === 'now') {

                    this.options.default = 'now';

                    var now = new Date(+ new Date() + this.options.fromnow),
                        hour = now.getHours(),
                        minute = now.getMinutes();

                    if( options.twelvehour ) {
                        value = [
                            leadingZero((hour == 0) ? 12 : ((hour >  12) ? (hour - 12) : hour)),
                            (leadingZero(minute) + (hour < 12 ? 'AM':'PM'))
                        ];
                    } else {
                        value = [ leadingZero(hour), leadingZero(minute) ];
                    }

                    submit = [ leadingZero(hour), leadingZero(minute), '00' ];
                    input.prop({
                        default:submit.join(':')
                    }).data({
                        default:submit.join(':'),
                        submit:submit.join(':')
                    }).attr({
                        'data-default':submit.join(':'),
                        'data-submit':submit.join(':')
                    });

                } else {
                    input.prop({value:(value[0] +':'+ value[1])})
                        .data({submit:submit.join(':')})
                        .attr({
                            value:(value[0] +':'+ value[1]),
                            'data-submit':submit.join(':')
                        });
                }

                if(options.darktheme)
                    popover.addClass('darktheme');

                // If autoclose is not setted, append a button
                $('<button type="button" class="btn-flat clockpicker-button" tabindex="' + (options.twelvehour? '3' : '1') + '">' + options.donetext + '</button>').click($.proxy(this.done, this)).appendTo(this.footer);

                this.spanHours.click($.proxy(this.toggleView, this, 'hours'));
                this.spanMinutes.click($.proxy(this.toggleView, this, 'minutes'));

                // Show or toggle
                input.on('focus.clockpicker click.clockpicker', $.proxy(this.show, this));

                // Build ticks
                var tickTpl = $('<div class="clockpicker-tick"></div>'),
                    i, tick, radian, radius;

                // Hours view
                if (options.twelvehour) {
                    for (i = 1; i < 13; i += 1) {
                        tick = tickTpl.clone();
                        radian = i / 6 * Math.PI;
                        radius = outerRadius;
                        tick.css('font-size', '140%');
                        tick.css({
                            left: dialRadius + Math.sin(radian) * radius - tickRadius,
                            top: dialRadius - Math.cos(radian) * radius - tickRadius
                        });
                        tick.html(i === 0 ? '00' : i);
                        hoursView.append(tick);
                        tick.on(mousedownEvent, mousedown);
                    }
                } else {
                    for (i = 0; i < 24; i += 1) {
                        tick = tickTpl.clone();
                        radian = i / 6 * Math.PI;
                        var inner = i > 0 && i < 13;
                        radius = inner ? innerRadius : outerRadius;
                        tick.css({
                            left: dialRadius + Math.sin(radian) * radius - tickRadius,
                            top: dialRadius - Math.cos(radian) * radius - tickRadius
                        });
                        if (inner)
                            tick.css('font-size', '120%');
                        tick.html(i === 0 ? '00' : i);
                        hoursView.append(tick);
                        tick.on(mousedownEvent, mousedown);
                    }
                }

                // Minutes view
                for (i = 0; i < 60; i += 5) {
                    tick = tickTpl.clone();
                    radian = i / 30 * Math.PI;
                    tick.css({
                        left: dialRadius + Math.sin(radian) * outerRadius - tickRadius,
                        top: dialRadius - Math.cos(radian) * outerRadius - tickRadius
                    });
                    tick.css('font-size', '140%');
                    tick.html(leadingZero(i));
                    minutesView.append(tick);
                    tick.on(mousedownEvent, mousedown);
                }

                // Clicking on minutes view space
                plate.on(mousedownEvent, function(e) {
                    if ($(e.target).closest('.clockpicker-tick').length === 0)
                        mousedown(e, true);
                });

                // Mousedown or touchstart
                function mousedown(e, space) {
                    var offset = plate.offset(),
                        isTouch = /^touch/.test(e.type),
                        x0 = offset.left + dialRadius,
                        y0 = offset.top + dialRadius,
                        dx = (isTouch ? e.originalEvent.touches[0] : e).pageX - x0,
                        dy = (isTouch ? e.originalEvent.touches[0] : e).pageY - y0,
                        z = Math.sqrt(dx * dx + dy * dy),
                        moved = false;

                    // When clicking on minutes view space, check the mouse position
                    if (space && (z < outerRadius - tickRadius || z > outerRadius + tickRadius))
                        return;
                    e.preventDefault();

                    // Set cursor style of body after 200ms
                    var movingTimer = setTimeout(function(){
                        self.popover.addClass('clockpicker-moving');
                    }, 200);

                    // Place the canvas to top
                    if (svgSupported)
                        plate.append(self.canvas);

                    // Clock
                    self.setHand(dx, dy, !space, true);

                    // Mousemove on document
                    $doc.off(mousemoveEvent).on(mousemoveEvent, function(e){
                        e.preventDefault();
                        var isTouch = /^touch/.test(e.type),
                            x = (isTouch ? e.originalEvent.touches[0] : e).pageX - x0,
                            y = (isTouch ? e.originalEvent.touches[0] : e).pageY - y0;
                        if (! moved && x === dx && y === dy)
                        // Clicking in chrome on windows will trigger a mousemove event
                            return;
                        moved = true;
                        self.setHand(x, y, false, true);
                    });

                    // Mouseup on document
                    $doc.off(mouseupEvent).on(mouseupEvent, function(e) {
                        $doc.off(mouseupEvent);
                        e.preventDefault();
                        var isTouch = /^touch/.test(e.type),
                            x = (isTouch ? e.originalEvent.changedTouches[0] : e).pageX - x0,
                            y = (isTouch ? e.originalEvent.changedTouches[0] : e).pageY - y0;
                        if ((space || moved) && x === dx && y === dy)
                            self.setHand(x, y);
                        if (self.currentView === 'hours')
                            self.toggleView('minutes', duration / 2);
                        else
                        if (options.autoclose) {
                            self.minutesView.addClass('clockpicker-dial-out');
                            setTimeout(function(){
                                self.done();
                            }, duration / 2);
                        }
                        plate.prepend(canvas);

                        // Reset cursor style of body
                        clearTimeout(movingTimer);
                        self.popover.removeClass('clockpicker-moving');

                        // Unbind mousemove event
                        $doc.off(mousemoveEvent);
                    });
                }

                if (svgSupported) {
                    // Draw clock hands and others
                    var canvas = popover.find('.clockpicker-canvas'),
                        svg = createSvgElement('svg');
                    svg.setAttribute('class', 'clockpicker-svg');
                    svg.setAttribute('width', diameter);
                    svg.setAttribute('height', diameter);
                    var g = createSvgElement('g');
                    g.setAttribute('transform', 'translate(' + dialRadius + ',' + dialRadius + ')');
                    var bearing = createSvgElement('circle');
                    bearing.setAttribute('class', 'clockpicker-canvas-bearing');
                    bearing.setAttribute('cx', 0);
                    bearing.setAttribute('cy', 0);
                    bearing.setAttribute('r', 2);
                    var hand = createSvgElement('line');
                    hand.setAttribute('x1', 0);
                    hand.setAttribute('y1', 0);
                    var bg = createSvgElement('circle');
                    bg.setAttribute('class', 'clockpicker-canvas-bg');
                    bg.setAttribute('r', tickRadius);
                    var fg = createSvgElement('circle');
                    fg.setAttribute('class', 'clockpicker-canvas-fg');
                    fg.setAttribute('r', 5);
                    g.appendChild(hand);
                    g.appendChild(bg);
                    g.appendChild(fg);
                    g.appendChild(bearing);
                    svg.appendChild(g);
                    canvas.append(svg);

                    this.hand = hand;
                    this.bg = bg;
                    this.fg = fg;
                    this.bearing = bearing;
                    this.g = g;
                    this.canvas = canvas;
                }

                raiseCallback(this.options.init);
            }

            function raiseCallback(callbackFunction) {
                if(callbackFunction && typeof callbackFunction === "function")
                    callbackFunction();
            }

            // Default options
            ClockPicker.DEFAULTS = {
                'default': '',         // default time, 'now' or '13:14' e.g.
                fromnow: 0,            // set default time to * milliseconds from now (using with default = 'now')
                donetext: 'Done',      // done button text
                autoclose: false,      // auto close when minute is selected
                ampmclickable: false,  // set am/pm button on itself
                darktheme: false,			 // set to dark theme
                twelvehour: true,      // change to 12 hour AM/PM clock from 24 hour
                vibrate: true,          // vibrate the device when dragging clock hand
                submit: ''
            };

            // Show or hide popover
            ClockPicker.prototype.toggle = function() {
                this[this.isShown ? 'hide' : 'show']();
            };

            // Set popover position
            ClockPicker.prototype.locate = function() {
                var element = this.element,
                    popover = this.popover,
                    offset = element.offset(),
                    width = element.outerWidth(),
                    height = element.outerHeight(),
                    align = this.options.align,
                    self = this;

                popover.show();
            };
            // Show popover
            ClockPicker.prototype.show = function(e){
                this.setAMorPM = function(option) {
                    var active = option;
                    var inactive = (option == "pm"? "am":"pm");
                    if(this.options.twelvehour) {
                        this.amOrPm = active.toUpperCase();
                        if(!this.options.ampmclickable) {
                            this.amPmBlock.children('.' + inactive + '-button').removeClass('active');
                            this.amPmBlock.children('.' + active + '-button').addClass('active');
                            this.spanAmPm.empty().append(this.amOrPm);
                        }
                        else {
                            this.spanAmPm.children('#click-' + active + '').addClass("text-primary");
                            this.spanAmPm.children('#click-' + inactive + '').removeClass("text-primary");
                        }
                    }
                }
                // Not show again
                if (this.isShown) {
                    return;
                }
                raiseCallback(this.options.beforeShow);
                $(':input').each(function() {
                    $(this).attr('tabindex', -1);
                })
                var self = this;
                // Initialize
                this.input.blur();
                this.popover.addClass('picker--opened');
                this.input.addClass('picker__input picker__input--active');
                $(document.body).css('overflow', 'hidden');
                if (!this.isAppended) {
                    // Append popover to options.container
                    if(this.options.hasOwnProperty('container'))
                        this.popover.appendTo(this.options.container);
                    else
                        this.popover.insertAfter(this.input);
                    this.setAMorPM("pm");
                    // Reset position when resize
                    $win.on('resize.clockpicker' + this.id, function() {
                        if (self.isShown) {
                            self.locate();
                        }
                    });
                    this.isAppended = true;
                }
                // Get the time
                var value = ((this.options['default'] || this.input.prop('value') || 'now') + '').split(':');

                if(this.options.twelvehour && !(typeof value[1] === 'undefined')) {
                    if(value[1].includes('AM') || parseInt(value[0]) < 12 )
                        this.setAMorPM("am");
                    else
                        this.setAMorPM("pm");

                    value[1] = value[1].replace("AM", "").replace("PM", "");
                }

                if (value[0] === 'now') {
                    var now = new Date(+ new Date() + this.options.fromnow);
                    if (now.getHours() >= 12)
                        this.setAMorPM("pm");
                    else
                        this.setAMorPM("am");
                    value = [
                        now.getHours(),
                        now.getMinutes()
                    ];
                }

                this.hours = + value[0] || 0;
                this.minutes = + value[1] || 0;
                this.spanHours.html(leadingZero(this.hours));
                this.spanMinutes.html(leadingZero(this.minutes));
                // Toggle to hours view
                this.toggleView('hours');
                // Set position
                this.locate();
                this.isShown = true;
                // Hide when clicking or tabbing on any element except the clock and input
                $doc.on('click.clockpicker.' + this.id + ' focusin.clockpicker.' + this.id, function(e) {
                    var target = $(e.target);
                    if (target.closest(self.popover.find('.picker__wrap')).length === 0 && target.closest(self.input).length === 0)
                        self.hide();
                });
                // Hide when ESC is pressed
                $doc.on('keyup.clockpicker.' + this.id, function(e){
                    if (e.keyCode === 27)
                        self.hide();
                });
                raiseCallback(this.options.afterShow);
            };
            // Hide popover
            ClockPicker.prototype.hide = function() {
                raiseCallback(this.options.beforeHide);
                this.input.removeClass('picker__input picker__input--active');
                this.popover.removeClass('picker--opened');
                $(document.body).css('overflow', 'visible');
                this.isShown = false;
                $(':input').each(function(index) {
                    $(this).attr('tabindex', index + 1);
                });
                // Unbinding events on document
                $doc.off('click.clockpicker.' + this.id + ' focusin.clockpicker.' + this.id);
                $doc.off('keyup.clockpicker.' + this.id);
                this.popover.hide();
                raiseCallback(this.options.afterHide);
            };
            // Toggle to hours or minutes view
            ClockPicker.prototype.toggleView = function(view, delay) {
                var raiseAfterHourSelect = false;
                if (view === 'minutes' && $(this.hoursView).css("visibility") === "visible") {
                    raiseCallback(this.options.beforeHourSelect);
                    raiseAfterHourSelect = true;
                }
                var isHours = view === 'hours',
                    nextView = isHours ? this.hoursView : this.minutesView,
                    hideView = isHours ? this.minutesView : this.hoursView;
                this.currentView = view;

                this.spanHours.toggleClass('text-primary', isHours);
                this.spanMinutes.toggleClass('text-primary', ! isHours);

                // Let's make transitions
                hideView.addClass('clockpicker-dial-out');
                nextView.css('visibility', 'visible').removeClass('clockpicker-dial-out');

                // Reset clock hand
                this.resetClock(delay);

                // After transitions ended
                clearTimeout(this.toggleViewTimer);
                this.toggleViewTimer = setTimeout(function() {
                    hideView.css('visibility', 'hidden');
                }, duration);

                if (raiseAfterHourSelect)
                    raiseCallback(this.options.afterHourSelect);
            };

            // Reset clock hand
            ClockPicker.prototype.resetClock = function(delay) {
                var view = this.currentView,
                    value = this[view],
                    isHours = view === 'hours',
                    unit = Math.PI / (isHours ? 6 : 30),
                    radian = value * unit,
                    radius = isHours && value > 0 && value < 13 ? innerRadius : outerRadius,
                    x = Math.sin(radian) * radius,
                    y = - Math.cos(radian) * radius,
                    self = this;

                if(svgSupported && delay) {
                    self.canvas.addClass('clockpicker-canvas-out');
                    setTimeout(function(){
                        self.canvas.removeClass('clockpicker-canvas-out');
                        self.setHand(x, y);
                    }, delay);
                } else
                    this.setHand(x, y);
            };

            // Set clock hand to (x, y)
            ClockPicker.prototype.setHand = function(x, y, roundBy5, dragging) {
                var radian = Math.atan2(x, - y),
                    isHours = this.currentView === 'hours',
                    unit = Math.PI / (isHours || roundBy5? 6 : 30),
                    z = Math.sqrt(x * x + y * y),
                    options = this.options,
                    inner = isHours && z < (outerRadius + innerRadius) / 2,
                    radius = inner ? innerRadius : outerRadius,
                    value;

                if (options.twelvehour)
                    radius = outerRadius;

                // Radian should in range [0, 2PI]
                if (radian < 0)
                    radian = Math.PI * 2 + radian;

                // Get the round value
                value = Math.round(radian / unit);

                // Get the round radian
                radian = value * unit;

                // Correct the hours or minutes
                if(options.twelvehour) {
                    if(isHours) {
                        if(value === 0)
                            value = 12;
                    } else {
                        if(roundBy5)
                            value *= 5;
                        if(value === 60)
                            value = 0;
                    }
                } else {
                    if(isHours) {
                        if(value === 12)
                            value = 0;
                        value = inner ? (value === 0 ? 12 : value) : value === 0 ? 0 : value + 12;
                    } else {
                        if(roundBy5)
                            value *= 5;
                        if(value === 60)
                            value = 0;
                    }
                }
                if (isHours)
                    this.fg.setAttribute('class', 'clockpicker-canvas-fg');
                else {
                    if(value % 5 == 0)
                        this.fg.setAttribute('class', 'clockpicker-canvas-fg');
                    else
                        this.fg.setAttribute('class', 'clockpicker-canvas-fg active');
                }

                // Once hours or minutes changed, vibrate the device
                if (this[this.currentView] !== value)
                    if (vibrate && this.options.vibrate)
                    // Do not vibrate too frequently
                        if (! this.vibrateTimer) {
                            navigator[vibrate](10);
                            this.vibrateTimer = setTimeout($.proxy(function(){
                                this.vibrateTimer = null;
                            }, this), 100);
                        }

                this[this.currentView] = value;
                this[isHours ? 'spanHours' : 'spanMinutes'].html(leadingZero(value));

                // If svg is not supported, just add an active class to the tick
                if (! svgSupported) {
                    this[isHours ? 'hoursView' : 'minutesView'].find('.clockpicker-tick').each(function(){
                        var tick = $(this);
                        tick.toggleClass('active', value === + tick.html());
                    });
                    return;
                }

                // Place clock hand at the top when dragging
                if (dragging || (! isHours && value % 5)) {
                    this.g.insertBefore(this.hand, this.bearing);
                    this.g.insertBefore(this.bg, this.fg);
                    this.bg.setAttribute('class', 'clockpicker-canvas-bg clockpicker-canvas-bg-trans');
                } else {
                    // Or place it at the bottom
                    this.g.insertBefore(this.hand, this.bg);
                    this.g.insertBefore(this.fg, this.bg);
                    this.bg.setAttribute('class', 'clockpicker-canvas-bg');
                }

                // Set clock hand and others' position
                var cx1 = Math.sin(radian) * (radius - tickRadius),
                    cy1 = - Math.cos(radian) * (radius - tickRadius),
                    cx2 = Math.sin(radian) * radius,
                    cy2 = - Math.cos(radian) * radius;
                this.hand.setAttribute('x2', cx1);
                this.hand.setAttribute('y2', cy1);
                this.bg.setAttribute('cx', cx2);
                this.bg.setAttribute('cy', cy2);
                this.fg.setAttribute('cx', cx2);
                this.fg.setAttribute('cy', cy2);
            };

            // Hours and minutes are selected
            ClockPicker.prototype.done = function() {
                raiseCallback(this.options.beforeDone);
                this.hide();
                this.label.addClass('active');

                var last = this.input.prop('value'),
                    value = leadingZero(this.hours) + ':' + leadingZero(this.minutes);
                submit = leadingZero(this.hours) + ':' + leadingZero(this.minutes) + ':00';

                if (this.options.twelvehour) {
                    value = value + this.amOrPm;
                    if ( this.amOrPm == 'PM' )
                        submit = ((this.hours < 12) ? (this.hours + 12) : 12) + ':' + leadingZero(this.minutes) + ':00';
                    else
                        submit = ((this.hours < 12) ? leadingZero(this.hours) : '00') + ':' + leadingZero(this.minutes) + ':00';
                }
                this.input
                    .prop({'value': value})
                    .data({'submit':submit})
                    .attr({'value': value, 'data-submit':submit});//Force data
                this.options.default = submit;
                if(value !== last) {
                    this.input.triggerHandler('change');
                    if(!this.isInput)
                        this.element.trigger('change');
                }
                if(this.options.autoclose)
                    this.input.trigger('blur');

                raiseCallback(this.options.afterDone(this.input, submit));
            };

            // Remove clockpicker from input
            ClockPicker.prototype.remove = function() {
                this.element.removeData('clockpicker');
                this.input.off('focus.clockpicker click.clockpicker');
                if (this.isShown)
                    this.hide();
                if (this.isAppended) {
                    $win.off('resize.clockpicker' + this.id);
                    this.popover.remove();
                }
            };

            // Extends $.fn.clockpicker
            $.fn.pickatime = function(option){
                var args = Array.prototype.slice.call(arguments, 1);
                return this.each(function(){
                    var $this = $(this),
                        data = $this.data('clockpicker');
                    if (!data) {
                        var options = $.extend({}, ClockPicker.DEFAULTS, $this.data(), typeof option == 'object' && option);
                        $this.data('clockpicker', new ClockPicker($this, options));
                    } else {
                        // Manual operatsions. show, hide, remove, e.g.
                        if (typeof data[option] === 'function')
                            data[option].apply(data, args);
                    }
                });
            };
        }());

        this.input
            .prop({value: value})
            .data({submit:submit})
            .attr({value: value, 'data-submit':submit}); //forzar nuevos valores

        this.options.default = submit;

        if(value !== last) {
            this.input.triggerHandler('change');
            if(!this.isInput)
                this.element.trigger('change');
        }

        if(this.options.autoclose)
            this.input.trigger('blur');

        raiseCallback(this.options.afterDone);
    };

    // Remove clockpicker from input
    ClockPicker.prototype.remove = function() {
        this.element.removeData('clockpicker');
        this.input.off('focus.clockpicker click.clockpicker');
        if (this.isShown)
            this.hide();
        if (this.isAppended) {
            $win.off('resize.clockpicker' + this.id);
            this.popover.remove();
        }
    };

    // Extends $.fn.clockpicker
    $.fn.pickatime = function(option){
        var args = Array.prototype.slice.call(arguments, 1);
        return this.each(function(){
            var $this = $(this),
                data = $this.data('clockpicker');
            if (!data) {
                var options = $.extend({}, ClockPicker.DEFAULTS, $this.data(), typeof option == 'object' && option);
                $this.data('clockpicker', new ClockPicker($this, options));
            } else {
                // Manual operatsions. show, hide, remove, e.g.
                if (typeof data[option] === 'function')
                    data[option].apply(data, args);
            }
        });
    };
}());
