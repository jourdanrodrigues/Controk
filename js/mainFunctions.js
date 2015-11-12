function loadFile(url){
    if(/css$/.test(url)&&$("link[href='css/"+url+"']").length===0) $("head").append("<link rel='stylesheet' href='css/"+url+"'>");
    else if(/js$/.test(url)&&$("script[src='js/"+url+"']").length===0) $("head").append("<script src='js/"+url+"'></script>");
}
function upperCaseFL(string){return string.replace(string[0],string[0].toUpperCase());}
function states(){
    return ["AC","AL","AP","AM","BA","CE","DF","ES","GO","MA","MT","MS","MG",
        "PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
}