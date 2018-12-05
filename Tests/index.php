<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 1:22 PM
 */

require '../autoload.php';
require '../vendor/autoload.php';
require 'BodyTest.php';

$btest = new BodyTest();
//$btest->odkform();
if (isset($_GET['form'])) {
  $btest->odkform();
 /* ?>
<h:html xmlns="http://www.w3.org/2002/xforms" xmlns:h="http://www.w3.org/1999/xhtml" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:jr="http://openrosa.org/javarosa">
  <h:head>
    <h:title>Untitled Form</h:title>
    <model>
      <instance>
        <data id="build_Untitled-Form_1544020592">
          <meta>
            <instanceID/>
          </meta>
          <sex/>
          <fname/>
          <sname/>
        </data>
      </instance>
      <itext>
        <translation lang="English">
          <text id="/data/sex:label">
            <value>Sex</value>
          </text>
          <text id="/data/sex:option0">
            <value>Male</value>
          </text>
          <text id="/data/sex:option1">
            <value>Female</value>
          </text>
          <text id="/data/fname:label">
            <value>First Name</value>
          </text>
          <text id="/data/sname:label">
            <value>Second Name</value>
          </text>
        </translation>
      </itext>
      <bind nodeset="/data/meta/instanceID" type="string" readonly="true()" calculate="concat('uuid:', uuid())"/>
      <bind nodeset="/data/sex" type="select1"/>
      <bind nodeset="/data/fname" type="string"/>
      <bind nodeset="/data/sname" type="string"/>
    </model>
  </h:head>
  <h:body>
    <select1 ref="/data/sex">
      <label ref="jr:itext('/data/sex:label')"/>
      <item>
        <label ref="jr:itext('/data/sex:option0')"/>
        <value>m</value>
      </item>
      <item>
        <label ref="jr:itext('/data/sex:option1')"/>
        <value>f</value>
      </item>
    </select1>
    <input ref="/data/fname">
      <label ref="jr:itext('/data/fname:label')"/>
    </input>
    <input ref="/data/sname">
      <label ref="jr:itext('/data/sname:label')"/>
    </input>
  </h:body>
</h:html>
  <?php */
}else{
  $btest->odkformlist();
}
