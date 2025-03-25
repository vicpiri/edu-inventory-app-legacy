<script>
var scripts = '';
var count = 0;
$('script').each(function(index, value){
    if (value.src === ''){
        scripts = scripts + '-' + '<br/>';
        console.log(value);
    }else{
        scripts = scripts + value.src + '<br/>';
    }
    count++;
});
scripts = scripts + '<br/>' + count + '<br/>';
//alert(scripts);
$('#mainframe').append(scripts);
</script>

