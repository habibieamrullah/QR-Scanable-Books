body{
    
    background-color: #f5f5f5;
    
    background: url(bg.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;

    margin: 0px;
    padding: 0px;
    
    font-family: 'Quicksand', sans-serif;
}

h1, h2, h3, h4, h5, p{
    margin: 0px;
}

.wrapper{
    max-width: 920px;
    margin: 0 auto;
    padding: 2em;
}

.loginblock{
    margin: 0 auto;
    width: 100%;
    max-width: 512px;
    vertical-align: middle;
    padding: 3em;
    background-color: white;
    margin-top: 1em;
    margin-bottom: 1em;
}

input{
    width: 100%;
    box-sizing: border-box;
    padding: 1em;
    margin-bottom: 0.3em;
    margin-top: 0.3em;
}

a{
    text-decoration: none;
    color: inherit;
}

a:hover{
    text-decoration: underline;
}

table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table td, table th {
  border: 1px solid #ddd;
  padding: 8px;
}

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #00caed;
  color: white;
}

.categorylist{
    display: table; width: 100%;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    padding: 0.5em;
    box-sizing: border-box;
}

.categorylist:hover{
    background-color: white;
}

.submitbutton{
    padding: 1em;
    background-color: #00caed;
    color: white;
    font-weight: bold;
    border: none;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    cursor: pointer;
}

.submitbutton:hover{
    background-color: #00a7c4;
}

.categoryitem{
    padding: 0.5em;
    cursor: pointer;
    border-bottom: 1px solid white;
    transition: all 0.5s;
}

.categoryitem:hover{
    background-color: white;
    color: #00a7c4;
}