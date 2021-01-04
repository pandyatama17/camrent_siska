{{-- <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet"> --}}
<style media="screen">

table.dataTable.dtr-inline.collapsed > tbody > tr > td.child,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.child,
table.dataTable.dtr-inline.collapsed > tbody > tr > td.dataTables_empty {
	cursor: default !important;
}
table.dataTable.dtr-inline.collapsed > tbody > tr > td.child:before,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.child:before,
table.dataTable.dtr-inline.collapsed > tbody > tr > td.dataTables_empty:before {
	display: none !important;
}
table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child,
table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > th:first-child {
	position: relative;
	padding-left: 30px;
	cursor: pointer;
}
table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child:before,
table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > th:first-child:before {

	left: 10px;
	height: 14px;
	width: 14px;
	display: block;
	font-weight: 900;
	position: absolute;
	top: 16px;
	color: white;
	padding: 2px;
	border-radius: 4px;
	box-shadow: 0 0 3px #444;
	box-sizing: content-box;
	text-align: center;
	text-indent: 0 !important;
	line-height: 14px;
	background-color: #0275d8;
	content: "\f078";

	/* top: 12px;
	color: #0275d8;
	content: "\f00e"; */
	font-family: 'Font Awesome 5 Free';
}
table.dataTable.dtr-inline.collapsed > tbody > tr.parent > td:first-child:before,
table.dataTable.dtr-inline.collapsed > tbody > tr.parent > th:first-child:before {
	background-color: #d33333;
	content: "\f077";

	/* content: "\f010";
	color: #d33333; */
	font-family: 'Font Awesome 5 Free';
}
table.dataTable.dtr-inline.collapsed.compact > tbody > tr > td:first-child,
table.dataTable.dtr-inline.collapsed.compact > tbody > tr > th:first-child {
	padding-left: 27px;
}
table.dataTable.dtr-inline.collapsed.compact > tbody > tr > td:first-child:before,
table.dataTable.dtr-inline.collapsed.compact > tbody > tr > th:first-child:before {
	top: 5px;
	left: 4px;
	height: 14px;
	width: 14px;
	border-radius: 14px;
	line-height: 14px;
	text-indent: 3px;
}
table.dataTable.dtr-column > tbody > tr > td.control,
table.dataTable.dtr-column > tbody > tr > th.control {
	position: relative;
	cursor: pointer;
}
table.dataTable.dtr-column > tbody > tr > td.control:before,
table.dataTable.dtr-column > tbody > tr > th.control:before {
	top: 50%;
	left: 50%;
	height: 16px;
	width: 16px;
	margin-top: -10px;
	margin-left: -10px;
	display: block;
	position: absolute;
	color: white;
	border: 2px solid white;
	border-radius: 14px;
	box-shadow: 0 0 3px #444;
	box-sizing: content-box;
	text-align: center;
	text-indent: 0 !important;
	font-family: 'Courier New', Courier, monospace;
	line-height: 14px;
	content: '+';
	background-color: #0275d8;
}
table.dataTable.dtr-column > tbody > tr.parent td.control:before,
table.dataTable.dtr-column > tbody > tr.parent th.control:before {
	content: '-';
	background-color: #d33333;
}
table.dataTable > tbody > tr.child {
	padding: 0.5em 1em;
}
table.dataTable > tbody > tr.child:hover {
	background: transparent !important;
}
table.dataTable > tbody > tr.child ul.dtr-details {
	display: inline-block;
	list-style-type: none;
	margin: 0;
	padding: 0;
}
table.dataTable > tbody > tr.child ul.dtr-details > li {
	border-bottom: 1px solid #efefef;
	padding: 0.5em 0;
}
table.dataTable > tbody > tr.child ul.dtr-details > li:first-child {
	padding-top: 0;
}
table.dataTable > tbody > tr.child ul.dtr-details > li:last-child {
	border-bottom: none;
}
table.dataTable > tbody > tr.child span.dtr-title {
	display: inline-block;
	min-width: 75px;
	font-weight: bold;
}

div.dtr-modal {
	position: fixed;
	box-sizing: border-box;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
	z-index: 100;
	padding: 10em 1em;
}
div.dtr-modal div.dtr-modal-display {
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	width: 50%;
	height: 50%;
	overflow: auto;
	margin: auto;
	z-index: 102;
	overflow: auto;
	background-color: #f5f5f7;
	border: 1px solid black;
	border-radius: 0.5em;
	box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6);
}
div.dtr-modal div.dtr-modal-content {
	position: relative;
	padding: 1em;
}
div.dtr-modal div.dtr-modal-close {
	position: absolute;
	top: 6px;
	right: 6px;
	width: 22px;
	height: 22px;
	border: 1px solid #eaeaea;
	background-color: #f9f9f9;
	text-align: center;
	border-radius: 3px;
	cursor: pointer;
	z-index: 12;
}
div.dtr-modal div.dtr-modal-close:hover {
	background-color: #eaeaea;
}
div.dtr-modal div.dtr-modal-background {
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 101;
	background: rgba(0, 0, 0, 0.6);
}
/* Chrome, Safari, Edge, Opera */
.phone::-webkit-outer-spin-button,
.phone::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
.phone {
  -moz-appearance: textfield;
}
@media screen and (max-width: 767px) {
	div.dtr-modal div.dtr-modal-display {
		width: 95%;
	}
}
div.dtr-bs-modal table.table tr:first-child td {
	border-top: none;
}

</style>

<style media="screen,print">
.clear{
  padding:1px;
}
.select2-results__options[id*="select2-sets"] .select2-results__option:nth-child(2) {
  background-color: #4da3ff;
  color:white;
  text-align: center;
  transition: .2s;
}
.select2-results__options[id*="select2-sets"] .select2-results__option:nth-child(2):hover {
  background-color: #007bff;
  transition: .2s;
}
.select2-results__options[id*="select2-sets"] .select2-results__option:nth-child(3) {
  background-color: #dc3545;
  color:white;
  text-align: center;
  transition: .2s;
}
.select2-results__options[id*="select2-sets"] .select2-results__option:nth-child(3):hover {
  background-color: #ff3333;
  transition: .2s;
}
.sizing-overlay
{
  position: absolute;
  top: 0;
  left: 0; /*make it stay on the grid*/
  height: 100%; /*cover grid area*/
  z-index: 999;
  width: 100%;
  text-align: center;
  background-color: rgba(184, 191, 198, 0.5)!important;

  /* display: none; */
}
.text-naval
{
  color: #40739e;
}
.bg-naval
{
  background-color: #487eb0;
  color:#fff;
}
.bg-naval:hover{
  background-color:#40739e;
  transition: .5s; color: white;
}
.text-protos{
  color:#00a8ff;
}
.bg-protos{
  background-color:#00a8ff;
  color:#fff;
}
.bg-protos:hover{
  background-color:#0097e6;
  transition: .5s; color: white;
}
.text-gold{
  color:#fbc531;
}
.bg-gold{
  background-color:#fbc531;
  color:#fff;
}
.bg-gold:hover{
  background-color:#e1b12c;
  transition: .5s; color: white;
}
.text-carribean{
  color:#1dd1a1;
}
.bg-carribean{
  background-color:#1dd1a1;
  color:#fff;
}
.bg-carribean:hover{
  background-color:#10ac84;
  transition: .5s; color: white;
}
.text-megaman{
  color:#48dbfb;
}
.bg-megaman{
  background-color:#48dbfb;
  color:#fff;
}
.bg-megaman:hover{
  background-color:#0abde3;
  transition: .5s; color: white;
}
.text-jade{
  color:#00d2d3;
}
.bg-jade{
  background-color:#00d2d3;
  color:#fff;
}
.bg-jade:hover{
  background-color:#01a3a4;
  transition: .5s; color: white;
}
.blur
{
  filter: blur(2px);

}
td.details-control:before {
    cursor: pointer;
}
tr.shown td.details-control::before {
    background: url('../resources/details_close.png') no-repeat center center;
}
.bg-lightgray{
  background-color: #b8bfc6!important;
  color:#000000!important;
}
.bg-lightergray{
  background-color: #d5d9dd!important;
  color:#000000!important;
}
.modal-fullscreen .modal-content {
    max-width: 100%;
    margin: 0;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100vh;
    display: flex;
    position: fixed;
    z-index: 100000;
}
.swal-wide{
    width:750px !important;
}
.vert-move {
  -webkit-animation: animate 1s infinite  alternate;
  animation: animate 1s infinite  alternate;
}
.vert-move {
  -webkit-animation: animate 1s infinite  alternate;
  animation: animate 1s infinite  alternate;
}
@-webkit-keyframes animate {
  0% { transform: translateY(0); }
  100% { transform: translateY(-10px); }
}
@keyframes animate {
  0% { transform: translateY(0); }
  100% { transform: translateY(-10px); }
}
.modal-lg{
    width:900px;
}

.modal-sm{
    width:300px;
}
.pageLoader
{
    position: absolute;
    top: 0;
    left: 0; /*make it stay on the grid*/
    height: 100%; /*cover grid area*/
    z-index: 999;
    width: 100%;
    display:table;
    background: rgba(0, 0, 0, 0.5);
    transition: all 0.5s;
}
.pageLoader i {
   display:table-cell;
    vertical-align:middle;
    text-align:center;
}
.custom-chk
{
  border-radius: 4px;
  background-color: #52a7e0;
  color:white;
  transition: .5s;
}
.custom-chk:hover
{
  background-color: #3498db;
}
.custom-chk.active
{
  background-color: #2283c3;
}
.custom-chk.active:hover
{
  background-color: #1a6698;
}
.phone::-webkit-inner-spin-button,
.phone::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.bg-custom-blue
{
  background-color: #215FA3;
  border-bottom: 1px solid white !important;
}
.bg-custom-blue:hover
{
  background-color: #1A4C82;
  transition: .5s!important;
}
.bg-custom-blue .active
{
  background-color: #113153;
  border-bottom: 1px solid white !important;
}
@font-face {
  font-family: 'Roboto Mono';
  font-style: normal;
  font-weight: normal;
  src: local('Roboto Mono'), url('{{asset('Roboto_Mono/static/RobotoMono-Regular.ttf')}}');
}
td.slashed{
	font-family: 'Roboto Mono', sans-serif!important;
	-webkit-font-feature-settings: "zero"!important;
	-moz-font-feature-settings: "zero=1"!important;
	-moz-font-feature-settings: "zero"!important;
	-ms-font-feature-settings: "zero"!important;
	-o-font-feature-settings: "zero"!important;
	font-feature-settings: "zero"!important;
  -webkit-font-feature-settings: "ss01", "ss02", "ss03", "ss04";
  font-feature-settings: "ss01", "ss02", "ss03", "ss04";
	font-variant: slashed-zero!important;
}
.table-plain tbody tr,
.table-plain tbody tr:hover,
.table-plain tbody td {
  background-color:transparent !important;
  border:none !important;
}
@media (max-width: 575.98px)
{
  .cart-container{
      width: 150%;
  }
}

@media (max-width: 767.98px) { ... }

@media (max-width: 991.98px) { ... }

@media (max-width: 1199.98px) { ... }
</style>
