
function nacionalidad_class() {
    this.init = function (id, params) {
        new p4.rem_request(this,function(obj,json){
            var jdata=JSON.parse(json);
            var p = $("#m_"+id);
            for(var j=0;j<jdata.codigos.length; j++){
                p.append("<option value=\""+jdata.codigos[j]+"\">"+jdata.descripciones[j]);
            }
            var sel = p.attr("data-selected");
            if(sel!="") {
                p.val(sel);
            }
        },"CIUDADANO::NACIONALIDAD","getPaises","");
    };
}

var nacionalidad_obj = new nacionalidad_class();


