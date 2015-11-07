$(document).ready(function(){
    $("body").fadeTo(600,1,"swing");
    $(".backToMain").click(function(){location.href="/";});
});
function generateField(obj){
    /* Parâmetros para geração de campos
     * id - classe de identificação da tag <p> (opcional);
     * field - classe de identificação do campo;
     * fieldTag - tipo do campo (default: "input");
     * readonly - campo somente leitura (opcional);
     * type - tipo de dado do campo (default: "text");
     * value - valor inicial de campo input (opcional);
     * lblContent - Conteúdo da label de identificação do campo;
     * plcHolder - Conteúdo do placeholder (opcional);
     * required - Setar campo como requerido (opcional);
     * rows - Linhas para type "textarea" (opcional);
     * cols - Colunas para type "textarea" (opcional);
     */
    var content="<p"+(typeof(obj.id)!="undefined"?" class='campoId"+obj.id+"'":"")+
        "><label data-for='"+obj.field+"'>"+obj.lblContent+"</label><br>";
    if(typeof(obj.fieldTag)!="undefined"&&obj.fieldTag==="textarea") content+="<textarea class='";
    else content+="<input type='"+(typeof(obj.type)!="undefined"?obj.type+"'":"text'")+" class='field ";
    content+=obj.field;
    if(typeof(obj.classes)!="undefined") for(var i=0;i<obj.classes.length;i++) content+=" "+obj.classes[i];
    //Atributos
    return content+"'"+(typeof(obj.rows)!="undefined"?" row="+obj.rows:"")+
            (typeof(obj.readonly)!="undefined"?" readonly=true":"")+
            (typeof(obj.cols)!="undefined"?" cols="+obj.cols:"")+
            (typeof(obj.value)!="undefined"?" value='"+obj.value+"'":"")+
            (typeof(obj.plcHolder)!="undefined"?" placeholder='"+obj.plcHolder+"'":"")+
            " required='required'"+
            //(typeof(obj.required)!="undefined"&&obj.required===1?" required='required'":"")+
            (typeof(obj.fieldTag)!="undefined"&&obj.fieldTag==="textarea"?"></textarea></p>":"></p>");
}