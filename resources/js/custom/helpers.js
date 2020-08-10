function unique(arr) {
    var obj = {};

    for (var i = 0; i < arr.length; i++) {
        var str = arr[i];
        obj[str] = true; // запомнить строку в виде свойства объекта
    }

    return Object.keys(obj); // или собрать ключи перебором для IE8-
}

function popup (nm, e) {
    return new Promise((resolve, reject) => {

        let popupElm = document.getElementById("popup-bg");

        if (nm == -1) {
            popupElm.classList.remove('visible');
            document.querySelector('body').style.overflow = 'auto';
            document.querySelector('body').style.overflowX = 'hidden';
            reject({visible: false, nm: nm, e: e});
        } else {
            let elm = popupElm.getElementsByClassName('popup');
            if (typeof nm != 'undefined') {
                for (var i = elm.length - 1; i >= 0; i--) {
                    if (elm[i].id == 'popup' + nm && typeof e !== 'undefined') {

                        elm[i].classList.add('visible');
                        popupElm.classList.add('visible');
                        document.querySelector('body').style.overflow = 'hidden';

                        resolve({visible: true, nm: nm, e: e});
                    }else {
                        elm[i].classList.remove('visible');
                    }
                }
            }
        }

    });
}

function getTextWidth(text, font) {
    // re-use canvas object for better performance
    var canvas = getTextWidth.canvas || (getTextWidth.canvas = document.createElement("canvas"));
    var context = canvas.getContext("2d");
    context.font = font;
    var metrics = context.measureText(text);
    return metrics.width;
}

function add_select_year(event, arr, year_of_issue_from, year_of_issue_before) {
    const TRANSPORT_DATA = {};
    if ($(event).parent('li').find('.from').length){
        $(event).parent('li').find('.block-year_of_issue').remove();
        $(event).parent('li').css({'padding-bottom' : '0px', 'margin-top' : '0px'});
        $(event).parent('li').find('a').css({'background' : 'none', 'padding-right':'0', 'padding-left':'0', 'color' : '#0c80ff'});
        for (let i = 0; i < arr.length; i++) {
            if (event.innerHTML == arr[i].model){
                arr.splice(i, 1);
            }
        }
    }
    else {
        let block = document.createElement('div');
        let select1 = document.createElement('select');
        let select2 = document.createElement('select');
        let p1 = document.createElement('p');
        let p2 = document.createElement('p');
        let p_text_1 = document.createTextNode('от');
        let p_text_2 = document.createTextNode('до');

        block.className = 'block-year_of_issue';
        p1.className = 'p_from';
        p2.className = 'p_before';
        select1.className = 'from';
        select2.className = 'before';
        select1.id = "select_from";
        select2.id = "select_before";

        select1.style.display = 'none';
        select2.style.display = 'none';

        if (!window.matchMedia("(max-width: 930px)").matches)
        {
            if ( $(event).parent('li').find('a').width() + 15 > 105) {
                block.style.marginLeft = 0 + 'px';
                block.style.marginTop = '25px';
                $(event).parent('li').css({'padding-bottom' : '24px',});
            } else
            {
                block.style.marginLeft = $(event).parent('li').find('a').width() + 15 + 'px';
            }
        }else{
            block.style.position = 'inherit';
        }

        for (let i=1990; i < 2020; i++ ){
            let option1 = document.createElement('option');
            let option2 = document.createElement('option');
            let text1 = document.createTextNode(i);
            let text2 = document.createTextNode(i);
            option1.append(text1);
            option2.append(text2);
            select1.append(option1);
            select2.append(option2);
        }

        p1.append(p_text_1);
        p2.append(p_text_2);
        block.append(p1);
        block.append(select1);
        block.append(p2);
        block.append(select2);

        $(event).parent('li').find('a').css({'background' : '#f6bf0045', 'padding-right':'10px', 'padding-left':'5px', 'color': 'rgb(131, 136, 132)'});
        $(event).parent('li').append(block);


        TRANSPORT_DATA['mark'] = $('#ajaxCatalog .model').text();
        TRANSPORT_DATA['model'] = event.innerHTML;

        if (typeof year_of_issue_from !== 'undefined' || typeof year_of_issue_before !== 'undefined') {
            $(event).parent().find('#select_from').val(year_of_issue_from);
            $(event).parent().find('#select_before').val(year_of_issue_before);
            TRANSPORT_DATA['year_from'] = $(event).parent().find('#select_from').val();
            TRANSPORT_DATA['year_before'] = $(event).parent().find('#select_before').val();
        }else{
            TRANSPORT_DATA['year_from'] = $(event).parent().find('#select_from').val();
            TRANSPORT_DATA['year_before'] = $(event).parent().find('#select_before').val();
        }

        $(event).parent().find('#select_from').change(function(){
            TRANSPORT_DATA['year_from'] = $(event).parent().find('#select_from').val();
        });

        $(event).parent().find('#select_before').change(function(){
            TRANSPORT_DATA['year_before'] = $(event).parent().find('#select_before').val();
        });

        $(event).parent('li').find('.from').niceSelect();
        $(event).parent('li').find('.before').niceSelect();

        arr.push(TRANSPORT_DATA);
    }
    return arr;
}

function undo_models (arr) {
    arr.splice(0, arr.length);
    $('#renderModels .block-year_of_issue').remove();
    $('#renderModels ul li a').removeAttr("style");

    return arr;
}

module.exports = {
    unique,
    popup,
    getTextWidth,
    add_select_year,
    undo_models,
};