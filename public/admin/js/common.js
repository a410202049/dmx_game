layui.use('laydate', function() {
    var laydate = layui.laydate;

    var start = {
        min: laydate.now()
        ,istoday: false
        ,choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };

    var end = {
        min: laydate.now()
        ,istoday: false
        ,choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };

    document.getElementById('start').onclick = function(){
        start.elem = this;
        laydate(start);
    }
    document.getElementById('end').onclick = function(){
        end.elem = this;
        laydate(end);
    }
})

$(function(){
    $('.recharge').click(function(){
        var accid =  $("#accid").val();
        var confirm_accid =  $("#confirm_accid").val();
        var diamond =  $("#diamond").val();
        console.log(diamond);
        $.ajax({
            type: 'POST',
            url: '/recharge',
            data: {accid:accid,confirm_accid:confirm_accid,diamond:diamond},
            dataType: "json",
            success: function(data){
                console.log(data);
            }
        });
    })
})