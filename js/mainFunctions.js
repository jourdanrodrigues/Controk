function loadFile(url){
    if(/css$/.test(url)&&$("link[href='css/"+url+"']").length===0) $("head").append("<link rel='stylesheet' href='css/"+url+"'>");
    else if(/js$/.test(url)&&$("script[src='js/"+url+"']").length===0) $("head").append("<script src='js/"+url+"'></script>");
}
function states(){
    return ["AC","AL","AP","AM","BA","CE","DF","ES","GO","MA","MT","MS","MG",
        "PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SC","SP","SE","TO"];
}
String.prototype.upperCaseFL=function(){this.replace(this[0],this[0].toUpperCase());};
String.prototype.format=function(type){
    if(this=="") return;
    var formated="";
    var value=this;
    if(type!="money"){
        if(/\W/.test(value)) while(/\W/.test(value)) formated=value=value.replace(/\W/,"");
        else for(var i=(type=="cpf"||type=="telCel"?11:(type=="cnpj"?14:(type=="telFixo"?10:8)))-1,a=value.length-1;i>=0;i--,a--)
            formated=(type=="cpf"?(i==9?"-"+value[a]:(i==6||i==3?"."+value[a]:value[a])):
            (type=="cnpj"?(i==12?"-"+value[a]:(i==8?"/"+value[a]:(i==5||i==2?"."+value[a]:value[a]))):
                (type=="telCel"?(i==7?"-"+value[a]:(i==3||i==2?" "+value[a]:(i==1?value[a]+")":(i==0?"("+value[a]:value[a])))):
                    (type=="telFixo"?(i==6?"-"+value[a]:(i==2?" "+value[a]:(i==1?value[a]+")":(i==0?"("+value[a]:value[a])))):
                        (i==5?"-"+value[a]:(i==2?"."+value[a]:value[a]))))))+formated;
    }else formated=(/^R/g.test(value))?value.replace(",",".").replace("R$ ",""):"R$ "+value.replace(".",",");
    return formated;
};