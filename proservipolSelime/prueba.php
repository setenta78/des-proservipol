<html><head>
<script>
function ordenar(o) {
    var v=new Array();
    for (var i=0; i<o.options.length; i++) {
        v[v.length]=new Array(o[i].text,o[i].value);
    }
    v.sort(compara);
    for (var i=0; i<o.options.length; i++) {
        o[i]=new Option(v[i][0],v[i][1],false,false);
    }
}
function compara(a, b) {
    return (a[0]<b[0]?"-1":"1");
}
</script>
</head>
<body><form>
<select size="6" name="D1" onchange="this.form.elegido.value=this.value">
    <option value="2">b</option>
    <option value="0">a</option>
    <option value="4">d</option>
    <option value="1">ac</option>
    <option value="3">c</option>
    <option value="5">za</option>
</select>
    <input type="button" value="sort" onclick="ordenar(this.form.D1)">
    <input type=text value="" name="elegido">
</form>
</body>
</html> 