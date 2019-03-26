f12Callback = {

    backdrop: document.createElement('div'),

    callbackModal: document.createElement('div'),

    xhr: new XMLHttpRequest(),

    xhrScript: new XMLHttpRequest(),

    callbackActionUrl: '',

    open: function (callbackActionUrl) {
        this.callbackActionUrl = callbackActionUrl;
        this.backdrop.setAttribute('class', 'f12-callback-backdrop');
        this.callbackModal.setAttribute('class', 'f12-callback-modal');
        this.backdrop.addEventListener('click', () => {
            this.close();
        });
        document.body.appendChild(this.backdrop);
        document.body.appendChild(this.callbackModal);
        setTimeout(function () {
            document.body.classList.add('f12-callback-modal-opened');
        }, 100);

        this.xhr.onload = function () {
            if (f12Callback.xhr.status >= 200 && f12Callback.xhr.status < 300) {
                f12Callback.callbackModal.innerHTML = f12Callback.xhr.responseText
                f12Callback.executeScripts();
            } else {
                console.log('The request failed!');
                console.log(f12Callback.xhr);
            }
        };

        this.xhr.open('GET', this.callbackActionUrl, true);
        this.xhr.send();
    },

    close: function () {
        document.body.classList.remove('f12-callback-modal-opened');
        setTimeout(function () {
            f12Callback.callbackModal.remove();
            f12Callback.backdrop.remove();
        }, 400);

    },

    submit: function () {
        form = document.getElementById('callback-form');

        this.xhr.open('POST', this.callbackActionUrl);
        this.xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        this.xhr.send(this.param(this.serializeForm(form)));
        return false;
    },

    serializeForm: function (form) {
        return Array.from(new FormData(form)
            .entries())
            .reduce(function (response, current) {
                response[current[0]] = current[1];
                return response
            }, {})
    },

    param: function (object) {
        var encodedString = '';
        for (var prop in object) {
            if (object.hasOwnProperty(prop)) {
                if (encodedString.length > 0) {
                    encodedString += '&';
                }
                encodedString += encodeURI(prop + '=' + object[prop]);
            }
        }
        return encodedString;
    },

    executeScripts: function () {
        let inlineScript = "";
        const scripts = Array.prototype.slice.call(f12Callback.callbackModal.getElementsByTagName("script"));
        for (var i = 0; i < scripts.length; i++) {
            if (scripts[i].src != "") {
                this.xhrScript.onload = function () {
                    if (f12Callback.xhrScript.status >= 200 && f12Callback.xhrScript.status < 300) {
                        eval(f12Callback.xhrScript.responseText);
                    } else {
                        console.log('The script load failed!');
                        console.log(f12Callback.xhrScript);
                    }
                };
                this.xhrScript.open('GET', scripts[i].src, false);
                this.xhrScript.send();
            } else {
                inlineScript += scripts[i].innerHTML;
            }
        }
        eval(inlineScript);
    },

    autoclose: function () {
        setTimeout(function () {
            f12Callback.close();
        }, 5000)
    }

}
