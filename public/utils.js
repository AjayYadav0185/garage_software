

const Utils = {
    CHART_COLORS: {
        lightBlue: '#4dc9f6',
        orange: '#f67019',
        pink: '#f53794',
        blue: '#537bc4',
        lightGreen: '#acc236',
        darkCyan : '#166a8f',
        green: '#00a950',
        gray: '#58595b',
        purple: '#8549ba',
        fill : 'rgba(90, 141, 238, 0.85)',
    },

    // color get
    randomColor: function() {
        const colors = Object.values(this.CHART_COLORS);
        return colors[Math.floor(Math.random() * colors.length)];
    },

    // transparent
    transparentize: function(color, opacity) {
        const alpha = opacity === undefined ? 0.5 : opacity;
        return color.replace('rgba', 'rgba').replace(')', `, ${alpha})`);  
    },

    // bar multiple color 
    barColors: function(dataLength) {
        const colors = [];
        for (let i = 0; i < dataLength; i++) {
            colors.push(this.randomColor()); 
        }
        return colors;
    }
    
};
