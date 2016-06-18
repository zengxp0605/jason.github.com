var board = [];
// 记录每个位置是否发送过叠加, 发生过则无法再次叠加
var hasConflicted = [];
var score = 0;
var ROW = App.const.ROW;
var COL = App.const.COL;
var isGameOver = false;
var startx, starty, endx, endy;

$(document).ready(function () {
    prepareForMoblie();
    newgame();
});

function prepareForMoblie() {
    // 处理pc等屏幕够大的情况
    if( App.sizeConf.documentWidth > 500 ){
        App.sizeConf.gridContainerWidth = 500;
        App.sizeConf.cellSpace = 20;
        App.sizeConf.cellSideLength = 100;
    }
    
    $('#grid-container').css('width', App.sizeConf.gridContainerWidth - 2*App.sizeConf.cellSpace);
    $('#grid-container').css('height',App.sizeConf.gridContainerWidth - 2*App.sizeConf.cellSpace);
    $('#grid-container').css('padding', App.sizeConf.cellSpace);
    $('#grid-container').css('border-radius',0.02*App.sizeConf.gridContainerWidth);

    $('.grid-cell').css('width',App.sizeConf.cellSideLength);
    $('.grid-cell').css('height',App.sizeConf.cellSideLength);
    $('.grid-cell').css('border-radius',0.02*App.sizeConf.cellSideLength);
}

function newgame(){
    // 初始化格子
    init();
    // 在随机的两个格子里生成数字
    generateOneNumber();
    generateOneNumber();
}

// 初始化格子
function init(){
    for (var i = 0; i < ROW; i++) {
        for (var j = 0; j < COL; j++) {
            var gridCell = $('#grid-cell-'+i+'-'+j);
            gridCell.css({
                'top': App.util.getPosTop(i, j),
                'left': App.util.getPosLeft(i, j),
            });             
        } 
    }

    for (var i = 0; i < ROW; i++) {
        board[i] = [];
        hasConflicted[i] = [];
        for (var j = 0; j < COL; j++) {
            board[i][j] = 0;         
            hasConflicted[i][j] = false;
        } 
    }

    updateBoardView();
    score = 0;
    isGameOver = false;
    $('#score').text( score );

}

var __debugNum__ = 0;
function updateBoardView(){

    $('.number-cell').remove();
    for (var i = 0; i < ROW; i++) {
        for (var j = 0; j < COL; j++) {
            var _tmp = '<div id="number-cell-'+ i + '-' + j + '" class="number-cell"></div>';
            $('#grid-container').append(_tmp);
            var theNumberCell = $('#number-cell-'+ i + '-' + j);
            if(!App.const.isDefaultNumber){
                theNumberCell.css({'font-size':'20px'});
            } else {
                var _numLen = ('' + board[i][j]).length;
                if( _numLen == 3){
                    theNumberCell.css({'font-size': 0.5*App.sizeConf.cellSideLength + 'px'});
                }else if( _numLen == 4){
                    theNumberCell.css({'font-size': 0.4*App.sizeConf.cellSideLength + 'px'});
                } else if (_numLen ==5){
                    theNumberCell.css({'font-size': 0.3*App.sizeConf.cellSideLength + 'px'});
                } else {
                    theNumberCell.css({'font-size': 0.6*App.sizeConf.cellSideLength + 'px'});
                }
            }
            if(board[i][j] == 0){
                theNumberCell.css({
                    'width' :'0px',
                    'height' :'0px',
                    'top': App.util.getPosTop(i, j) + App.sizeConf.cellSideLength / 2,
                    'left': App.util.getPosLeft(i, j) + App.sizeConf.cellSideLength / 2,
                });             
            } else {

                theNumberCell.css({
                    'width' : App.sizeConf.cellSideLength + 'px',
                    'height' : App.sizeConf.cellSideLength + 'px',
                    'top': App.util.getPosTop(i, j),
                    'left': App.util.getPosLeft(i, j),
                    'background-color': App.util.getNumberBgColor(board[i][j]),
                    'color': App.util.getNumberColor(board[i][j]),
                });  
                theNumberCell.text( App.util.getNumberText(board[i][j]));
            }
            hasConflicted[i][j] = false; // 复位
        } 
    }
    $('.number-cell').css({'line-height': App.sizeConf.cellSideLength + 'px'});
    // $('.number-cell').css({'font-size': 0.6*App.sizeConf.cellSideLength + 'px'});
}
// 自己优化的方法
function generateOneNumber() {
    var emptyPos = [];
    for( var i = 0 ; i < ROW ; i ++ ){
        for( var j = 0 ; j < COL ; j ++ ){
            if( board[i][j] == 0 ){
                emptyPos.push({x: i, y: j});
            }
        }            
    }
    // 没有空白的了
    if(emptyPos.length <= 0){
        return false; 
    }
    // 数组中随机取一个键
    var _randIndex = parseInt(Math.random() * (emptyPos.length - 1)); 
    if(_randIndex >= emptyPos.length)
        _randIndex = emptyPos.length - 1;

    var randx = emptyPos[_randIndex].x;
    var randy = emptyPos[_randIndex].y;
    // 随机一个数字, 2 || 4
    var randNumer = Math.random() < 0.5 ? 2 : 4;     
    // 显示数字
    board[randx][randy] = randNumer;
    App.animation.showNumber(randx, randy, randNumer);

    return true;
}

function generateOneNumber_bak() {
    if(App.util.nospace(board)) {
        return false;
    }
    // 随机一个位置
    var randx = parseInt( Math.floor(Math.random() * 4) );
    var randy = parseInt( Math.floor(Math.random() * 4) );
    var _times = 0;
    while(_times < 50){
        if(board[randx][randy] == 0)
            break;
        var randx = parseInt( Math.floor(Math.random() * 4) );
        var randy = parseInt( Math.floor(Math.random() * 4) );
        _times ++;
    }
    // 没有随机到合适的值, 人工找一个
    if(_times == 50){
        var _break = false;
          for( var i = 0 ; i < ROW ; i ++ )
            for( var j = 1 ; j < COL ; j ++ ){
                if(board[i][j] ==0){
                    randx = i;
                    randy = j;
                    _break = true;
                    break;
                }
                if(_break) break;
            }
    }
    // 随机一个数字, 2 || 4
    var randNumer = Math.random() < 0.5 ? 2 : 4;     
    // 显示数字
    board[randx][randy] = randNumer;
    App.animation.showNumber(randx, randy, randNumer);

    return true;
}

// 响应键盘 上下左右
$(document).keydown(function(event){
    if(isGameOver === true)
        return true;
    event.preventDefault();

    switch(event.keyCode){
        case 37: // left
            if( moveLeft() ){
                setTimeout(generateOneNumber, 210);
                setTimeout(checkGameOver, 300);
            }
            break;
        case 38: // up
            if( moveUp() ){
                setTimeout(generateOneNumber, 210);
                setTimeout(checkGameOver, 300);
            }
            break;
        case 39: // right
            if( moveRight() ){
                setTimeout(generateOneNumber, 210);
                setTimeout(checkGameOver, 300);
            }
            break;
        case 40: // down
            if( moveDown() ){
                setTimeout(generateOneNumber, 210);
                setTimeout(checkGameOver, 300);
            }
            break;
        default:
            break;
    }
});

// 移动端事件
document.addEventListener('touchstart', function(e){
    e.preventDefault();
    var _touch = e.touches[0];
    startx = _touch.pageX;
    starty = _touch.pageY;
});
document.addEventListener('touchmove', function(e){
    e.preventDefault();
});
document.addEventListener('touchend', function(e){
    e.preventDefault();
    var _touch = e.changedTouches[0];
    endx = _touch.pageX;
    endy = _touch.pageY;
    var deltax = endx - startx;
    var deltay = endy - starty;
    // 滑动距离太小, 不处理
    var _minW = 0.2*App.sizeConf.documentWidth;
    if(Math.abs(deltax) < _minW && Math.abs(deltay) < _minW)
        return;

    if(Math.abs(deltax) >= Math.abs(deltay)){
        // x
        if(deltax > 0){ // right
            if( moveRight() ){
                setTimeout(generateOneNumber, 210);
                setTimeout(checkGameOver, 300);
            }
        }else{ // left
            if( moveLeft() ){
                setTimeout(generateOneNumber, 210);
                setTimeout(checkGameOver, 300);
            }
        }
    } else {
        // y
        if(deltay > 0){ // down
            if( moveDown() ){
                setTimeout(generateOneNumber, 210);
                setTimeout(checkGameOver, 300);
            }
        }else{ // up
            if( moveUp() ){
                setTimeout(generateOneNumber, 210);
                setTimeout(checkGameOver, 300);
            }
        }
    }
});


function moveLeft(){
    if(!App.util.canMoveLeft(board)){
        return false;
    }

    for( var i = 0 ; i < ROW ; i ++ ){
        for( var j = 1 ; j < COL ; j ++ ){ // j = 0 时是最左边一列,无法左移
            if( board[i][j] == 0 ) // 跳过空白格子
                continue;
            
            for(var k=0; k<j; k++){
                // 左侧为空, 或者左侧数字和当前格子数字一致, 可以左移动
                if(board[i][k] == 0 && App.util.noBlockHorizontal(i , k, j, board)){
                    // move
                    App.animation.showMove(i,j, i,k);
                    board[i][k] = board[i][j]; // i,j 移动到 i,k
                    board[i][j] = 0;
                    continue;   
                } else if(board[i][k] == board[i][j] && App.util.noBlockHorizontal(i , k, j, board)
                    && !hasConflicted[i][k] ){
                    // move
                    App.animation.showMove(i,j, i,k);
                    // add
                    board[i][k] += board[i][j] + __debugNum__; // i,j 移动到 i,k, 并相加
                    board[i][j] = 0;
                    //add score
                    score += board[i][k];
                    App.animation.updateScore( score );
                    hasConflicted[i][k] = true;
                    continue;
                }

            }
        }
    }

    setTimeout(updateBoardView, 200);
    return true;
}

function moveRight(){
    if(!App.util.canMoveRight(board)){

        return false;
    }

    for( var i = 0 ; i < ROW ; i ++ ){
        for( var j = 2 ; j >= 0 ; j--){ 
            if( board[i][j] != 0 ) {
            
                for(var k=3; k>j; k--){
                    // 右侧为空, 或者右侧数字和当前格子数字一致, 可以右移动
                    if(board[i][k] == 0 && App.util.noBlockHorizontal(i , j, k, board)){
                        // move
                        App.animation.showMove(i,j, i,k);
                        board[i][k] = board[i][j]; // i,j 移动到 i,k
                        board[i][j] = 0;
                        continue;   
                    } else if(board[i][k] == board[i][j] && App.util.noBlockHorizontal(i , j, k, board) &&
                            !hasConflicted[i][k] ){
                        // move
                        App.animation.showMove(i,j, i,k);
                        // add
                        board[i][k] += board[i][j]; // i,j 移动到 i,k, 并相加
                        board[i][j] = 0;
                        //add score
                        score += board[i][k];
                        App.animation.updateScore( score );
                        hasConflicted[i][k] = true;
                        continue;
                    }

                }
            }
        }
    }

    setTimeout(updateBoardView, 200);
    return true;
}

function moveRight_bak(){
    if( !App.util.canMoveRight( board ) )
        return false;

    //moveRight
    for( var i = 0 ; i < 4 ; i ++ )
        for( var j = 2 ; j >= 0 ; j -- ){
            if( board[i][j] != 0 ){
                for( var k = 3 ; k > j ; k -- ){

                    if( board[i][k] == 0 && App.util.noBlockHorizontal( i , j , k , board ) ){
                        //move
                        App.animation.showMove( i , j , i , k );
                        board[i][k] = board[i][j];
                        board[i][j] = 0;
                        continue;
                    }
                    else if( board[i][k] == board[i][j] && App.util.noBlockHorizontal( i , j , k , board ) && !hasConflicted[i][k] ){
                        //move
                        App.animation.showMove( i , j , i , k);
                        //add
                        board[i][k] += board[i][j];
                        board[i][j] = 0;
                        //add score
                        score += board[i][k];
                        App.animation.updateScore( score );

                        hasConflicted[i][k] = true;
                        continue;
                    }
                }
            }
        }

    setTimeout("updateBoardView()",200);
    return true;
}

function moveUp(){
    if( !App.util.canMoveUp( board ) )
        return false;

    //moveUp
    for( var j = 0 ; j < COL ; j ++ )
        for( var i = 1 ; i < ROW ; i ++ ){
            if( board[i][j] != 0 ){
                for( var k = 0 ; k < i ; k ++ ){

                    if( board[k][j] == 0 && App.util.noBlockVertical( j , k , i , board ) ){
                        //move
                        App.animation.showMove( i , j , k , j );
                        board[k][j] = board[i][j];
                        board[i][j] = 0;
                        continue;
                    }
                    else if( board[k][j] == board[i][j] && App.util.noBlockVertical( j , k , i , board ) 
                        && !hasConflicted[k][j] ){
                        //move
                        App.animation.showMove( i , j , k , j );
                        //add
                        board[k][j] += board[i][j];
                        board[i][j] = 0;
                        //add score
                        score += board[k][j];
                        App.animation.updateScore( score );

                        hasConflicted[k][j] = true;
                        continue;
                    }
                }
            }
        }

    setTimeout(updateBoardView, 200);
    return true;
}

function moveDown(){
    if( !App.util.canMoveDown( board ) )
        return false;

    //moveDown
    for( var j = 0 ; j < 4 ; j ++ )
        for( var i = 2 ; i >= 0 ; i -- ){
            if( board[i][j] != 0 ){
                for( var k = 3 ; k > i ; k -- ){

                    if( board[k][j] == 0 && App.util.noBlockVertical( j , i , k , board ) ){
                        //move
                        App.animation.showMove( i , j , k , j );
                        board[k][j] = board[i][j];
                        board[i][j] = 0;
                        continue;
                    }
                    else if( board[k][j] == board[i][j] && App.util.noBlockVertical( j , i , k , board ) 
                        && !hasConflicted[k][j] ){
                        //move
                        App.animation.showMove( i , j , k , j );
                        //add
                        board[k][j] += board[i][j];
                        board[i][j] = 0;
                        //add score
                        score += board[k][j];
                        App.animation.updateScore( score );

                        hasConflicted[k][j] = true;
                        continue;
                    }
                }
            }
        }

    setTimeout(updateBoardView,200);
    return true;
}

// 判断游戏是否结束
function checkGameOver(){
    // 没有空格, 并且不能移动时,游戏结束
    if(App.util.nospace(board) && App.util.nomove(board)) {
        isGameOver = true;
        gameOver();
    }
}

function gameOver(){
    alert('Game Over!');
}

