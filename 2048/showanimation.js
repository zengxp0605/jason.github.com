(function ($, window) {
    window.App = window.App || {};
    var animation = {};
    var util = App.util;
    var sizeConf = App.sizeConf;

    animation.showNumber = function( i , j , randNumber ){

        var numberCell = $('#number-cell-' + i + "-" + j );

        numberCell.css('background-color', util.getNumberBgColor( randNumber ) );
        numberCell.css('color', util.getNumberColor( randNumber ) );
        numberCell.text( App.util.getNumberText(randNumber) );

        numberCell.css({'font-size': 0.6*App.sizeConf.cellSideLength + 'px'});

        numberCell.animate({
            width: sizeConf.cellSideLength + "px",
            height: sizeConf.cellSideLength + "px",
            top: util.getPosTop( i , j ),
            left: util.getPosLeft( i , j )
        }, 50);
    };

    animation.showMove = function(fromx, fromy, tox, toy){
        var numberCell = $('#number-cell-' + fromx + "-" + fromy );

        numberCell.animate({
            top: util.getPosTop( tox , toy ),
            left: util.getPosLeft( tox , toy )
        }, 200);
    };

    animation.updateScore = function( score ){
        $('#score').text( score );
    }

    window.App.animation = animation;
})($, window);