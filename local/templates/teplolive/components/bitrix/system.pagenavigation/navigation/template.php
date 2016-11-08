<div class='catalog-navi'>
<?
 $space = html_entity_decode('&nbsp');
 $pegasus = '&rarr;';
 $unicorn='&larr;';
if($this->NavPageNomer > 1)
  echo ('<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.
  $this->NavNum.'='.($this->NavPageNomer-1).$strNavQueryString.'#nav_start'.
  $add_anchor.'">'.html_entity_decode($unicorn).'</a>&nbsp; '); 

$NavRecordGroup = $nStartPage;
//echo "^*%".$nEndPage."@!#";
if ($nEndPage < 7 ){
    for ($i = 1; $i<7; $i++){
      if ($i > $nEndPage){
        break;
      }
      if($i == $this->NavPageNomer) 
        echo('<span> '.$i.$space.' </span>'); 
      else
        echo('<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$i.$strNavQueryString.'#nav_start'.$add_anchor.'">'.$i.'</a> '.$space);
    }
}
else {
if  ($this->NavPageNomer < 4 ){
  for ($i = 1; $i<5; $i++){
    if ($i > $nEndPage)
    {
      break;
    }
    if($i == $this->NavPageNomer) 
      echo('<span> '.$i.$space.' </span>'); 
    else
      echo('<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$i.$strNavQueryString.'#nav_start'.$add_anchor.'">'.$i.'</a> '.$space);
  }
  echo ' ... '.$space.'<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$nEndPage.$strNavQueryString.'#nav_start'.$add_anchor.'"> '.$nEndPage.' </a>';

}

if ($this->NavPageNomer == 4 ){
  for ($i = 1; $i<7; $i++){
    if ($i > $nEndPage)
    {
      break;
    }
    if($i == $this->NavPageNomer) 
      echo('<span> '.$i.$space.' </span>'); 
    else
      echo('<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$i.$strNavQueryString.'#nav_start'.$add_anchor.'">'.$i.'</a> '.$space);
  }
  echo ' ... '.$space.'<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$nEndPage.$strNavQueryString.'#nav_start'.$add_anchor.'"> '.$nEndPage.' </a>';
}

if ($this->NavPageNomer > 4 )
{
  echo '<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'=1'.$strNavQueryString.'#nav_start'.$add_anchor.'"> 1 </a>'.$space.' ... '.$space;  
    if ($this->NavPageNomer > ($nEndPage-4)) {
    for ($i = ($nEndPage-4); $i<=($nEndPage); $i++)
    {
      if($i == $this->NavPageNomer) 
        echo('<span> '.$i.$space.' </span>'); 
      else
        echo('<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$i.$strNavQueryString.'#nav_start'.$add_anchor.'">'.$i.'</a> '.$space);
    }
    }
    else {
  for ($i = ($this->NavPageNomer-2); $i<($this->NavPageNomer+3); $i++){
    if ($i > $nEndPage)
    {
      break;
    }
    if($i == $this->NavPageNomer) 
      echo('<span> '.$i.$space.' </span>'); 
    else
      echo('<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$i.$strNavQueryString.'#nav_start'.$add_anchor.'">'.$i.'</a> '.$space);
  }
  if ($i < ($nEndPage-1)){
    echo ' ... '.$space.'<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$nEndPage.$strNavQueryString.'#nav_start'.$add_anchor.'"> '.$nEndPage.' </a>';
  }
  if ($i == ($nEndPage-1)){
    echo('<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$i.$strNavQueryString.'#nav_start'.$add_anchor.'">'.$i.'</a> '.$space);
    echo '<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$nEndPage.$strNavQueryString.'#nav_start'.$add_anchor.'"> '.$nEndPage.' </a>';
  }
  if ($i == ($nEndPage)){
    echo '<a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.$nEndPage.$strNavQueryString.'#nav_start'.$add_anchor.'">'.$nEndPage.'</a>';
  }
  if ($i > ($nEndPage-3)){
    echo "";  
  } 
}
}
}

if($this->NavPageNomer < $this->NavPageCount)
  echo ($space.' <a class="navi-link" href="'.$sUrlPath.'?PAGEN_'.$this->NavNum.'='.
  ($this->NavPageNomer+1).$strNavQueryString.'#nav_start'.$add_anchor.'">'.html_entity_decode($pegasus).'</a>');

?>
</div>