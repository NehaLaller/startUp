# startUp
<html>
<head>
<script type = "text/javascript">
   
 var a;
 var temp;
 var vals = [50,40,30,20,10,15];
for(a=0;a<vals.length;)
{
if(vals[a] < vals[a-1])
{
temp=vals[a];
vals[a]=vals[a-1];
vals[a-1]=temp;
a--;
}
else{
a++;}
}


for(a=0;a<vals.length;a++)
    {
       document.write( vals[a]+ " "); 
     }

</script>
</head>
</html>
