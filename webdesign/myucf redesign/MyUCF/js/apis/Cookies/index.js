// Quirksmode.org Cookies API
// Edited by Danny Acosta Forte

class Cookies {
    static set(name, value, days = 30) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }
    
    static get(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    
    static delete(name) {
        this.set(name,"",-1);
    }

    static getAsJSON(name) {
        const rawCookie = this.get(name);
        return rawCookie ? JSON.parse(rawCookie) : {};
    }

    static setAsJSON(name, value, days = 30) {
        this.set(name, JSON.stringify(value), days);
    }
}

export default Cookies;