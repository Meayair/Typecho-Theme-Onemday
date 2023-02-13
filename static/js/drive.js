(function(global) {
    var apple_phone = /iPhone/i,
        apple_ipod = /iPod/i,
        apple_tablet = /iPad/i,
        android_phone = /(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,
        android_tablet = /Android/i,
        amazon_phone = /(?=.*\bAndroid\b)(?=.*\bSD4930UR\b)/i,
        amazon_tablet = /(?=.*\bAndroid\b)(?=.*\b(?:KFOT|KFTT|KFJWI|KFJWA|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|KFARWI|KFASWI|KFSAWI|KFSAWA)\b)/i,
        windows_phone = /IEMobile/i,
        windows_tablet = /(?=.*\bWindows\b)(?=.*\bARM\b)/i,
        other_blackberry = /BlackBerry/i,
        other_blackberry_10 = /BB10/i,
        other_opera = /Opera Mini/i,
        other_chrome = /(CriOS|Chrome)(?=.*\bMobile\b)/i,
        other_firefox = /(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,
        seven_inch = new RegExp('(?:' + 'Nexus 7' + '|' + 'BNTV250' + '|' + 'Kindle Fire' + '|' + 'Silk' + '|' + 'GT-P1000' + ')', 'i');
    var match = function(regex, userAgent) {
        return regex.test(userAgent);
    };
    var IsMobileClass = function(userAgent) {
        var ua = userAgent || navigator.userAgent;
        var tmp = ua.split('[FBAN');
        if (typeof tmp[1] !== 'undefined') {
            ua = tmp[0];
        }
        tmp = ua.split('Twitter');
        if (typeof tmp[1] !== 'undefined') {
            ua = tmp[0];
        }
        this.apple = {
            phone: match(apple_phone, ua),
            ipod: match(apple_ipod, ua),
            tablet: !match(apple_phone, ua) && match(apple_tablet, ua),
            device: match(apple_phone, ua) || match(apple_ipod, ua) || match(apple_tablet, ua)
        };
        this.amazon = {
            phone: match(amazon_phone, ua),
            tablet: !match(amazon_phone, ua) && match(amazon_tablet, ua),
            device: match(amazon_phone, ua) || match(amazon_tablet, ua)
        };
        this.android = {
            phone: match(amazon_phone, ua) || match(android_phone, ua),
            tablet: !match(amazon_phone, ua) && !match(android_phone, ua) && (match(amazon_tablet, ua) || match(android_tablet, ua)),
            device: match(amazon_phone, ua) || match(amazon_tablet, ua) || match(android_phone, ua) || match(android_tablet, ua)
        };
        this.windows = {
            phone: match(windows_phone, ua),
            tablet: match(windows_tablet, ua),
            device: match(windows_phone, ua) || match(windows_tablet, ua)
        };
        this.other = {
            blackberry: match(other_blackberry, ua),
            blackberry10: match(other_blackberry_10, ua),
            opera: match(other_opera, ua),
            firefox: match(other_firefox, ua),
            chrome: match(other_chrome, ua),
            device: match(other_blackberry, ua) || match(other_blackberry_10, ua) || match(other_opera, ua) || match(other_firefox, ua) || match(other_chrome, ua)
        };
        this.seven_inch = match(seven_inch, ua);
        this.any = this.apple.device || this.android.device || this.windows.device || this.other.device || this.seven_inch;
        this.phone = this.apple.phone || this.android.phone || this.windows.phone;
        this.tablet = this.apple.tablet || this.android.tablet || this.windows.tablet;
        if (typeof window === 'undefined') {
            return this;
        }
    };
    var instantiate = function() {
        var IM = new IsMobileClass();
        IM.Class = IsMobileClass;
        return IM;
    };
    if (typeof module !== 'undefined' && module.exports && typeof window === 'undefined') {
        module.exports = IsMobileClass;
    } else if (typeof module !== 'undefined' && module.exports && typeof window !== 'undefined') {
        module.exports = instantiate();
    } else if (typeof define === 'function' && define.amd) {
        define('isMobile', [], global.isMobile = instantiate());
    } else {
        global.isMobile = instantiate();
    }
})(this);
if (isMobile.any) {
    document.addEventListener('touchstart', handleTouchStart, false);
    document.addEventListener('touchmove', handleTouchMove, false);
    var xDown = null;
    var yDown = null;
    var callAction = [1, 1, 2, 2, -1, -2, -1, -2];
    var pointer = 0;
    var displayed = false;
    var upcnt = 0;

    function handleTouchStart(evt) {
        xDown = evt.touches[0].clientX;
        yDown = evt.touches[0].clientY;
    };

    function handleTouchMove(evt) {
        if (!xDown || !yDown) {
            return;
        }
        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;
        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;
        if (Math.abs(xDiff) > Math.abs(yDiff)) {
            if (xDiff > 0) {
                if (callAction[pointer] == 3 || callAction[pointer] == -1) {
                    pointer++;
                } else {
                    pointer = 0;
                }
                upcnt = 0;
            } else {
                if (callAction[pointer] == 4 || callAction[pointer] == -2) {
                    pointer++;
                } else {
                    pointer = 0;
                }
                upcnt = 0;
            }
        } else {
            if (yDiff > 0) {
                if (callAction[pointer] == 1 || callAction[pointer] == -1) {
                    pointer++;
                } else {
                    pointer = 0;
                }
                upcnt++;
            } else {
                if (upcnt >= 2) {
                    pointer = 2;
                }
                if (callAction[pointer] == 2 || callAction[pointer] == -2) {
                    pointer++;
                } else {
                    pointer = 0;
                }
                upcnt = 0;
            }
        }
        if (pointer >= callAction.length) {
            displayed = true;
            pointer = 0;
            var drive =  $(".drive")[0];
            drive.style.display = 'block';
        }
        xDown = null;
        yDown = null;
    };
} else {
    (function($) {
        var pointer = 0;
        var displayed = false;
        $(document).on('keydown.passwordCheck', function(event) {
            var callAction = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65, 66, 65];
            if ((event.keyCode == callAction[pointer]) || (event.which === callAction[pointer])) {
                pointer++;
            } else {
                pointer = 0;
            }
            if (pointer >= callAction.length) {
                displayed = true;
                var drive =  $(".drive")[0];
                drive.style.display = 'block';
            }
        });
    })(jQuery);
}
var drive =  $(".drive")[0];
drive.style.display = 'none';