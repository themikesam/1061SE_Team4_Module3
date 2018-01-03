function now() {
    return (new Date).getTime();
}
jQuery.fx.prototype.custom = function( from, to, unit ) {
    this.startTime = now();
    this.start = from;
    this.end = to;
    this.unit = unit || this.unit || "px";
    this.now = this.start;
    this.pos = this.state = 0;

    var self = this;
    function t( gotoEnd ) {
        return self.step(gotoEnd);
    }

    t.elem = this.elem;

    if ( t() && jQuery.timers.push(t) && !jQuery.fx.prototype.timerId ) {
        //timerId = setInterval(jQuery.fx.tick, 130);
        jQuery.fx.prototype.timerId = setInterval(jQuery.fx.tick, 1000);
    }
}