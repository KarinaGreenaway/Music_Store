function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete your account?');
   if(conf)
      window.location=anchor.attr("href");
}