$(document).ready(function(){
    var num1; 
    var num2;
    var provinces=[
        "北京市",
        '天津市',
        '河北省',
    ];
    var cities=[
        [
            '北京市市辖区'
        ],
        [
            '天津市市辖区',
            '天津市郊县'
        ],
        [
            '石家庄市',
            '唐山市',
            '秦皇岛市',
            '邯郸市',
            '邢台市',
            '保定市',
            '张家口市',
            '承德市',
            '沧州市',
            '廊坊市',
            '衡水市'
        ],

    ];
    var countires=[
        [
            ['东城区','西城区','朝阳区','丰台区','石景山区','海淀区','门头沟区','房山区','通州区','顺义区','昌平区','大兴区','怀柔区','平谷区','密云区','延庆区']
        ],
        [
            ['和平区','河东区','河西区','南开区','河北区','红桥区','东丽区','西青区','津南区','北辰区','武清区','宝坻区','滨海新区','宁河区','静海区'],
            ['蓟县']
        ],
        [
            ['长安区','桥西区','新华区','井陉矿区','裕华区','藁城区','鹿泉区','栾城区','井陉县','正定县','行唐县','灵寿县','高邑县','深泽县','赞皇县','无极县','平山县','元氏县','赵县','辛集市','晋州市','新乐市'],
            ['路南区','路北区','古冶区','开平区','丰南区','丰润区','曹妃甸区','滦县','滦南县','乐亭县','迁西县','玉田县','遵化市','迁安市'],
            ['海港区','山海关区','北戴河区','抚宁区','青龙满族自治县','昌黎县','卢龙县'],
            ['邯山区','丛台区','复兴区','峰峰矿区','邯郸县','临漳县','成安县','大名县','涉县','磁县','肥乡县','永年县','邱县','鸡泽县','广平县','馆陶县','魏县','曲周县','武安市'],
            ['桥东区','桥西区','邢台县','临城县','内丘县','柏乡县','隆尧县','任县','南和县','宁晋县','巨鹿县','新河县','广宗县','平乡县','威县','清河县','临西县','南宫市','沙河市'],
            ['竞秀区','莲池区','满城区','清苑区','徐水区','涞水县','阜平县','定兴县','唐县','高阳县','容城县','涞源县','望都县','安新县','易县','曲阳县','蠡县','顺平县','博野县','雄县','涿州市','定州市','安国市','高碑店市'],
            ['桥东区','桥西区','宣化区','下花园区','宣化县','张北县','康保县','沽源县','尚义县','蔚县','阳原县','怀安县','万全县','怀来县','涿鹿县','赤城县','崇礼县'],
            ['双桥区','双滦区','鹰手营子矿区','承德县','兴隆县','平泉县','滦平县','隆化县','丰宁满族自治县','宽城满族自治县','围场满族蒙古族自治县'],
            ['新华区','运河区','沧县','青县','东光县','海兴县','盐山县','肃宁县','南皮县','吴桥县','献县','孟村回族自治县','泊头市','任丘市','黄骅市','河间市'],
            ['安次区','广阳区','固安县','永清县','香河县','大城县','文安县','大厂回族自治县','霸州市','三河市'],
            ['桃城区','枣强县','武邑县','武强县','饶阳县','安平县','故城县','景县','阜城县','冀州市','深州市']
        ],
    ];
    $(function(){
        for(var i=0;i<provinces.length;i++){
        $("#province").append("<option>"+provinces[i]+"</option>");
        }
        $("#province").change(function(){
            $("#city").children().not(":eq(0)").remove();
            num1=$(this).children("option:selected").index();
            var acity1=cities[num1-1];
            console.log(num1);
            for(var j=0;j<acity1.length;j++){
            $("#city").append("<option>"+acity1[j]+"</option>");
            }
        $("#city").change(function(){
            $("#country").children().not(":eq(0)").remove();
            num2=$(this).children("option:selected").index();
            var contries1=countires[num1-1][num2-1];
            for( var z=0;z<contries1.length;z++){
            $("#country").append("<option>"+contries1[z]+"</option>");
            }
            });
            });
        });
})