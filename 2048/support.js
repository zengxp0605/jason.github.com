(function ($, window) {
    window.App = window.App || {};
    var util = {};
    var ROW = App.const.ROW || 4;
    var COL = App.const.COL || 4;

    var sizeConf = App.sizeConf;

    util.getPosTop = function( i , j ){
        return sizeConf.cellSpace + i* (sizeConf.cellSpace + sizeConf.cellSideLength);
    };

    util.getPosLeft = function( i , j ){
        return sizeConf.cellSpace + j* (sizeConf.cellSpace + sizeConf.cellSideLength);
    };

    util.getNumberBgColor = function(number){
        switch( number ){
            case 2: _color = "#eee4da";break;
            case 4: _color = "#ede0c8";break;
            case 8: _color = "#f2b179";break;
            case 16: _color = "#f59563";break;
            case 32: _color = "#f67c5f";break;
            case 64: _color = "#f65e3b";break;
            case 128: _color = "#edcf72";break;
            case 256: _color = "#edcc61";break;
            case 512: _color = "#9c0";break;
            case 1024: _color = "#33b5e5";break;
            case 2048: _color = "#09c";break;
            case 4096: _color = "#a6c";break;
            case 8192: _color = "#93c";break;
            default: _color = 'black';
        }
        return _color;
    };

    util.getNumberColor = function(number){
        if( number <= 4 )
            return "#776e65";
        return "white";
    };

    // 值为0 表示为空, 有空格,返回false
    util.nospace = function( board ){
        for( var i = 0 ; i < ROW ; i ++ )
            for( var j = 0 ; j < COL ; j ++ )
                if( board[i][j] == 0 )
                    return false;

        return true;
    }

    // 判断是否可以移动 left
    util.canMoveLeft = function(board){
        for( var i = 0 ; i < ROW ; i ++ )
            for( var j = 1 ; j < COL ; j ++ ){ // j = 0 时是最左边一列,无法左移
                if( board[i][j] != 0 ) {
                    // 左侧为空, 或者左侧数字和当前格子数字一致, 可以左移动
                    if(board[i][j-1] == 0 || board[i][j-1] == board[i][j])
                        return true;   
                }
            }

        return false;
    };

    // 判断是否可以移动 Right
    util.canMoveRight = function(board){

        for( var i = 0 ; i < 4 ; i ++ )
        for( var j = 2; j >= 0 ; j -- )
            if( board[i][j] != 0 )
                if( board[i][j+1] == 0 || board[i][j+1] == board[i][j] )
                    return true;
        return false;
    };

    // 判断是否可以移动 Up
    util.canMoveUp = function(board){
        for( var j = 0 ; j < COL; j ++ ){ 
            for( var i = 1 ; i < ROW ; i ++ ){ // 最上面一行不能上移
                if( board[i][j] != 0 ){ // 跳过空白格子
                    // 上方为空, 或者上方数字和当前格子数字一致, 可以上移
                    if(board[i-1][j] == 0 || board[i-1][j] == board[i][j])
                        return true;   
                }
            }
        }    
        return false;
    };


    // 判断是否可以移动 Down
    util.canMoveDown = function(board){
        for( var j = 0 ; j < COL; j ++ ){ 
            for( var i = ROW - 2 ; i >=0 ; i -- ){ // 最下面面一行不能下移
                if( board[i][j] != 0 ){ // 跳过空白格子
                    // 下方为空, 或者下方数字和当前格子数字一致, 可以下移
                    if(board[i+1][j] == 0 || board[i+1][j] == board[i][j])
                        return true;   
                }
            }
        }
        return false;
    };

    // 判断横向是否有障碍
    util.noBlockHorizontal = function(row, col1, col2, board) {
        for(var i = col1 + 1; i < col2; i ++){
            if(board[row][i] != 0) // 有一格不为空,即有障碍
                return false;
        }
        return true;
    };

    // 判断纵向是否有障碍
    util.noBlockVertical = function(col, row1, row2, board) {
        for(var j = row1 + 1; j < row2; j ++){
            if(board[j][col] != 0) // 有一格不为空,即有障碍
                return false;
        }
        return true;
    };

    util.nomove = function(board) {
        if(util.canMoveLeft(board) ||
            util.canMoveRight(board) ||
            util.canMoveUp(board) ||
            util.canMoveDown(board) ){
                return false;
        }
        return true;
    };


    util.getNumberText = function( number ){
        if(App.const.isDefaultNumber)
            return number;

        switch( number ){
            case 2:return "小白";break;
            case 4:return "实习生";break;
            case 8:return "程序猿";break;
            case 16:return "项目经理";break;
            case 32:return "架构师";break;
            case 64:return "技术经理";break;
            case 128:return "高级经理";break;
            case 256:return "技术总监";break;
            case 512:return "副总裁";break;
            case 1024:return "CTO";break;
            case 2048:return "总裁";break;
            case 4096:return "#a6c";break;
            case 8192:return "#93c";break;
        }

        return "black";
    }

    window.App.util = util;
})($, window);



 
