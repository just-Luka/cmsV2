export default class Date {
    constructor(time) {
        this.time = time;
    }

    /**
     *
     * @returns {boolean}
     */
    timestampValidation() {
        return this.time.length == 27;
    }

    /**
     *
     * @returns {*|string}
     * @constructor
     */
    YMD() {
        return this.timestampValidation() ? this.time.slice(0,10) : '';
    }

    /**
     *
     * @returns {*|string}
     * @constructor
     */
    HMS() {
        return this.timestampValidation() ? this.time.slice(11,19) : '';
    }

    /**
     *
     * @returns {string|string}
     * @constructor
     */
    YMDwithHMS() {
        return this.timestampValidation() ? this.YMD() + ' ' + this.HMS() : '';
    }
}
