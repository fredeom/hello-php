function pageIdChanged(elem, direction) {
    var pageId = document.querySelector('input[name=pageid]');
    var strvalue = pageId.getAttribute('value');
    var value = parseInt(strvalue);
    if ("" + value != strvalue || value <= 0) {
        value = 1;
    } else {
        var pageCount = parseInt(document.querySelector("#pagecount").innerHTML);
        if (value > pageCount) {
            value = pageCount;
        } else {
            switch (direction) {
                case 'left' : if (value > 1) value = value - 1; break;
                case 'right': if (value < pageCount) value = value + 1; break;
                default: alert('bug');
            }
        }
    }
    pageId.setAttribute('value', value);
    elem.form.submit();
}

function sortBy(colname) {
    var elem = document.querySelector("input[name='sortBy']");
    var val = elem.getAttribute('value');
    if (val.indexOf(colname) >= 0) {
        if (val.indexOf('desc') > 0) val = val.replace('desc', 'asc'); else
        if (val.indexOf('asc' ) > 0) val = val.replace('asc', 'desc');
    } else {
        val = colname + ' asc';
    }
    elem.setAttribute('value', val);
    elem.form.submit();
}