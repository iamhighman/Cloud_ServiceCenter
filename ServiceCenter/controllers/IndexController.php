<?php


class IndexController extends Controller
{

    private $infoTab = NULL;
    private $myTab = NULL;
    private $ws = NULL;
    private $member = NULL;
    private $manager = NULL;
    private $googleclass = NULL;
    private $pubMessage = NULL;

    private $participant = NULL;
    private $multiArticle = NULL;
    
    //This part is added by highman
    private $ComponentManager = NULL;
    private $MenuManager = NULL;
    private $ServiceInterface = NULL;
    private $CheckCredit = NULL;

    public function __construct()
    {
        $this->infoTab = new infoTab;
        $this->myTab = new myTab;
        $this->pubTab = new pubTab;
        
        $this->member = new member;
        $this->manager = new manager;       
        $this->ws = new WebService;
        $this->participant = new participant;
        $this->googleclass = new GoogleClass;
        $this->multiArticle = new multiArticle;
        $this->pubMessage = new pubMessage;
        
        //This part is added by highman
        $this->ComponentManager = new ComponentManager;
        $this->MenuManager = new MenuManager;
        $this->ServiceInterface = new ServiceInterface;
        $this->CheckCredit = new CheckCredit;
    }

    protected function getShortDocs(){
        $link = $_GET['link'];
        echo $this->googleclass->getShortDocs($link,100);
    }
    
    protected function testaction()
    {
    	$view = new HtmlView;	
    	$view->setVar('Profile', "test");
    	$view->render("testaction.tpl.php");
    }
    
    
    protected function getPickManager(){
    	  $id = $_GET['id'];  
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getPickManager($id));
        $view->render('member.tpl.php');    	
    }

    protected function PickData(){
        $id = $_GET['id'];
        $cid = $_GET['cid'];   
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getPickDataForm($id, $cid));
        $view->render('member.tpl.php');    	      	
    }

    protected function AddPickForm(){ 
    	  $cid = $_GET['cid'];  
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getPickAddForm($cid));
        $view->render('member.tpl.php');    	
    }

    protected function AddPick(){
        $this->manager->addPickData($_POST);
        $this->redirectTo('./index.php?act=ManagerCourse'); 	
    }

    protected function updatePickData(){        
        $this->manager->updatePickData($_POST);
        $this->redirectTo('./index.php?act=ManagerCourse');   	      	
    }

    protected function delPickData(){  
    	  $id = $_GET['id'];      
        $this->manager->delPickData($id);
        $this->redirectTo('./index.php?act=ManagerCourse');   	      	
    }

    protected function getCourseManager(){
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getCourseManager());
        $view->render('member.tpl.php');    	
    }

    protected function CourseData(){
        $id = $_GET['id'];       
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getCourseDataForm($id));
        $view->render('member.tpl.php');    	      	
    }

    protected function delCourseData(){  
    	  $id = $_GET['id'];      
        $this->manager->delCourseData($id);
        $this->redirectTo('./index.php?act=ManagerCourse');   	      	
    }

    protected function updateCourseData(){        
        $this->manager->updateCourseData($_POST);
        $this->redirectTo('./index.php?act=ManagerCourse');   	      	
    }

    protected function AddCourseForm(){ 
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getCourseAddForm());
        $view->render('member.tpl.php');    	
    }

    protected function AddCourse(){
        $this->manager->addCourseData($_POST);
        $this->redirectTo('./index.php?act=ManagerCourse'); 	
    }

    protected function ManagerCourse(){ 
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getCourseManager());
        $view->render('member.tpl.php');
    }  

    protected function TeamData(){
        $id = $_GET['id'];       
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getTeamDataForm($id));
        $view->render('member.tpl.php');    	      	
    }

    protected function delTeamData(){  
    	  $id = $_GET['id'];      
        $this->manager->delTeamData($id);
        $this->redirectTo('./index.php?act=ManagerCourse');   	      	
    }

    protected function updateTeamData(){        
        $this->manager->updateTeamData($_POST);
        $this->redirectTo('./index.php?act=ManagerCourse');   	      	
    }

    protected function AddTeamForm(){ 
    	  $cid = $_GET['cid']; 
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getTeamAddForm($cid));
        $view->render('member.tpl.php');    	
    }

    protected function AddTeam(){
        $this->manager->addTeamData($_POST);
        $this->redirectTo('./index.php?act=ManagerCourse'); 	
    }

    protected function getTeamManager(){ 
        $id = $_GET['id'];    
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getTeamManager($id));
        $view->render('member.tpl.php');
    }    

    protected function UData(){
        $id = $_GET['id'];       
        $view = new HtmlView;
        $view->setVar('DataForm', $this->member->getDataForm($id));
        $view->render('member.tpl.php');    	      	
    }

    protected function delUData(){  
    	  $id = $_GET['id'];      
        $this->member->delData($id);
        $this->redirectTo('./index.php?act=ManagerData');   	      	
    }

    protected function updateUData(){        
        $this->member->updateData($_POST);
        $this->redirectTo('./index.php?act=ManagerData');   
        	      	
    }
    
    protected function SavePubMessage(){    
    	
        $this->pubMessage->newIsay($_POST);
        //sleep(3);
        //$this->redirectTo('./index.php?act=GetPubMessage');  
        	      	
    }

    protected function GetPubMessage(){   
    	$view = new HtmlView;     
        $view->setVar('DataForm', $this->pubMessage->getIsay());
        $view->render('pubMessage.tpl.php');     	
    }
    protected function GetAllPubMessage(){   
    	$view = new HtmlView;     
        $view->setVar('DataForm', $this->pubMessage->getALLsay());
        $view->render('pubMessage.tpl.php');     	
    }

    protected function AddUserForm(){ 
        $view = new HtmlView;
        $view->setVar('DataForm', $this->member->getAddForm());
        $view->render('member.tpl.php');    	
    }

    protected function AddUser(){
        $this->member->addData($_POST);
        $this->redirectTo('./index.php?act=ManagerData'); 	
    }

    protected function UpdatePassword(){ 
    	  $view = new HtmlView;
        $view->setVar('DataForm', $this->member->UpdatePassword($_POST));
        //$this->redirectTo('./index.php?act=ManagerData'); 
        $view->render('member.tpl.php');
    }
    protected function UpdatePhoto(){ 
    	$id = $_POST['id'];
    	$image = $_FILES['userfile'];
    	$view = new HtmlView;
        $view->setVar('DataForm', $this->member->UpdatePhoto($id,$image));
        //$this->redirectTo('./index.php?act=ManagerData'); 
        $view->render('member.tpl.php');
    }
    
    protected function Article(){  
     	$view = new HtmlView;
        $view->setVar('DataForm', $this->multiArticle->Article());
        $view->setVar('DataForm2', $this->multiArticle->CourseGlobalIT());
        $view->setVar('DataForm3', $this->multiArticle->CourseBusinessNet());
        $view->setVar('DataForm4', $this->multiArticle->CourseGlobalInvest());
        $view->setVar('DataForm5', $this->multiArticle->CourseDiscuss());
        $view->setVar('DataForm6', $this->multiArticle->LatestArticle());
        $view->render('multiArticle.tpl.php');
        
        
    }  
    protected function getArticle(){  
    	$id = $_GET['id'];  
     	$view = new HtmlView;
        $view->setVar('DataForm', $this->multiArticle->getArticle($id));
        //$view->setVar('DataForm2', $this->multiArticle->getArticle($id));
        ///$view->setVar('DataForm3', $this->multiArticle->getArticle($id));
        //$/view->setVar('DataForm4', $this->multiArticle->getArticle($id));
        //$view->setVar('DataForm5', $this->multiArticle->getArticle($id));
        $view->render('getArticle.tpl.php');
        
        
    }   
    protected function findTag(){  
    	 $tag = $_GET['id'];   
    	
    	$view = new HtmlView;
        $view->setVar('DataForm', $this->multiArticle->findTag($tag));
        $view->render('findTag.tpl.php');
        
        
    }   
    protected function stdArticle(){  
    	 $id = $_GET['id'];   
    	
    	$view = new HtmlView;
        $view->setVar('DataForm', $this->multiArticle->getStdArticle($id));
        $view->render('stdArticle.tpl.php');
        
        
    }   
    protected function scoreArticle(){ 

    	$view = new HtmlView;
        $view->setVar('DataForm', $this->multiArticle->scoreArticle($_POST));
        $this->redirectTo('./index.php?act=Article');   
        //$view->render('multiArticle.tpl.php');
    }
    protected function postArticle(){ 

    	$view = new HtmlView;
        $view->setVar('DataForm', $this->multiArticle->postArticle($_POST));
        //$this->redirectTo('./index.php?act=Article'); 
    }

    protected function ManagerData(){ 
        $view = new HtmlView;
        $view->setVar('DataForm', $this->member->getManager());
        $view->render('member.tpl.php');
    }
    
    protected function getParticipant(){ 
        $id = $_GET['id']; echo "ID=$id";
        $view = new HtmlView;
        $view->setVar('DataForm', $this->participant->getParticipant($id));
        $view->render('participant.tpl.php');
    }     
     
    protected function Participant_XML()
    {
        $view = new XmlView;
        $id = $_GET['id'];
        $view->setVar('action', $this->participant->getAction()."&amp;id=$id");
        $view->setVar('title', $this->participant->getTitle());
        $view->setVar('items', $this->participant->getPref());
        $view->render();
    }
    protected function manager_XML()
    {
        $view = new XmlView;
        $view->setVar('action', $this->manager->getAction());
        $view->setVar('title', $this->manager->getTitle());
        $view->setVar('items', $this->manager->getPref());
        $view->render();
    }

    protected function Manager(){  
        $view = new HtmlView;
        $view->setVar('DataForm', $this->manager->getManager());
        $view->render('member.tpl.php');    	      	
    }

    protected function ChangePasswordTab_XML()
    {
        $view = new XmlView;
        $view->setVar('action', "ChangePasswordForm");
        $view->setVar('title', "ChangePasswordTab");
        $view->setVar('items', "");
        $view->render();
    }
    protected function Article_XML()
    {
        $view = new XmlView;
        $view->setVar('action', "Article");
        $view->setVar('title', "Article");
        $view->setVar('items', "");
        $view->render();
    }
    protected function pubMessage_XML()
    {
        $view = new XmlView;
        $view->setVar('action', "GetPubMessage");
        $view->setVar('title', "pubMessage");
        $view->setVar('items', "");
        $view->render();
    }

    protected function ChangePasswordForm(){ 
        $view = new HtmlView;
        $view->setVar('DataForm', $this->member->getChangePasswordForm());
        $view->render('member.tpl.php');
    }

    

    protected function infoTab_XML()
    {
        $view = new XmlView;
        $view->setVar('action', $this->infoTab->getAction());
        $view->setVar('title', $this->infoTab->getTitle());
        $view->setVar('items', $this->infoTab->getPref());
        $view->render();
    }

    protected function infoTab()
    {
        $view = new HtmlView;
        $view->setVar('Course', $this->infoTab->getCourse());
        $view->setVar('Project', $this->infoTab->getProject());
        $view->setVar('Member', $this->infoTab->getMember());
        $view->render('infoTab.tpl.php');
    }

    protected function myTab_XML()
    {
        $view = new XmlView;
        $view->setVar('action', $this->myTab->getAction());
        $view->setVar('title', $this->myTab->getTitle());
        $view->setVar('items', $this->myTab->getPref());
        $view->render();
    }

    protected function myTab()
    {    
    	  $uid = $_GET[uid];
    	  $upa = $_GET[upa];    	  
    	  $id = $this->myTab->ifLogin($uid, $upa);
    	  
        $view = new HtmlView;        
        if($id > 0){
        	 $view->setVar('Profile', $this->myTab->getProfile($id));
        	 $view->setVar('Course', $this->myTab->getCourse($id));
        	 $view->setVar('Photo', $this->myTab->getPhoto($id));
           $view->render('myTab.tpl.php');
        }else{
           $view->render('myTab.tpl.php');
           if($uid != "") echo "Error! <input type=button value=\"Clear\" name=\"Clear\" onClick=\"ClearUid()\">";
           
        }
    }

    protected function pubTab_XML()
    {
        $view = new XmlView;
        $view->setVar('action', $this->pubTab->getAction());
        $view->setVar('title', $this->pubTab->getTitle());
        $view->setVar('items', $this->pubTab->getPref());
        $view->render();
    }

    protected function pubTab()
    {
        $view = new HtmlView;
        $view->setVar('Content', $this->pubTab->getRandom5());
        $view->render('pubTab.tpl.php');
    }

    protected function index()
    {
        //$view = new XmlView;
       //$view->setVar('action', "infoTab");
        //$view->render();
        
        echo "Service Center <br> Please browser by gadget.";
    }

//--This part is added by highman

    protected function ComponentManager_XML()
    {
        $view = new XmlView;
        $view->setVar('action', $this->ComponentManager->getAction());
        $view->setVar('title', $this->ComponentManager->getTitle());
        $view->setVar('items', $this->ComponentManager->getPref());
        $view->render();
    }

    protected function ComponentManager(){  
        $view = new HtmlView;
        $view->setVar('DataForm', $this->ComponentManager->getComponentManager());
        $view->render('ComponentManager.tpl.php');    	      	
    }

    protected function editComponentData(){
        $id = $_GET['id'];       
        $view = new HtmlView;
        $view->setVar('DataForm', $this->ComponentManager->getComponentDataForm($id));
        $view->render('ComponentManager.tpl.php');          	
    }

    protected function delComponent(){  
    	  $id = $_GET['id'];      
        $this->ComponentManager->delComponentData($id);
        $this->redirectTo('./index.php?act=ComponentManager');   	      	
    }

    protected function updateConponent(){        
        $this->ComponentManager->updateComponentData($_POST);
        $this->redirectTo('./index.php?act=ComponentManager');   	      	
    }

    protected function addConponentData(){ 
        $view = new HtmlView;
        $view->setVar('DataForm', $this->ComponentManager->getComponentAddForm());
        $view->render('ComponentManager.tpl.php');    
    }

    protected function addComponent(){
        $this->ComponentManager->addComponentData($_POST);
        $this->redirectTo('./index.php?act=ComponentManager'); 	
    }

    protected function MenuManager_XML()
    {
        $view = new XmlView;
        $view->setVar('action', $this->MenuManager->getAction());
        $view->setVar('title', $this->MenuManager->getTitle());
        $view->setVar('items', $this->MenuManager->getPref());
        $view->render();
    }

    protected function MenuManager(){  
        $view = new HtmlView;
        $view->setVar('DataForm', $this->MenuManager->getMenuManager());
        $view->render('MenuManager.tpl.php');    	      	
    }

    protected function editMenuData(){
        $id = $_GET['id'];       
        $view = new HtmlView;
        $view->setVar('DataForm', $this->MenuManager->getMenuDataForm($id));
        $view->render('MenuManager.tpl.php');          	
    }

    protected function delMenu(){  
    	  $id = $_GET['id'];      
        $this->MenuManager->delMenuData($id);
        $this->redirectTo('./index.php?act=MenuManager');   	      	
    }

    protected function updateMenu(){        
        $this->MenuManager->updateMenuData($_POST);
        $this->redirectTo('./index.php?act=MenuManager');   	      	
    }

    protected function addMenuData(){ 
        $view = new HtmlView;
        $view->setVar('DataForm', $this->MenuManager->getMenuAddForm());
        $view->render('MenuManager.tpl.php');    
    }

    protected function addMenu(){
        $this->MenuManager->addMenuData($_POST);
        $this->redirectTo('./index.php?act=MenuManager'); 	
    }

    protected function ServiceInterface_XML()
    {
        $view = new XmlView;
        $view->setVar('action', $this->ServiceInterface->getAction());
        $view->setVar('title', $this->ServiceInterface->getTitle());
        $view->setVar('items', $this->ServiceInterface->getPref());
        $view->render();
    }

    protected function ServiceInterface()
    {    
    	  $uid = $_GET[uid];
    	  $upa = $_GET[upa];    	  
    	  $id = $this->ServiceInterface->ifLogin($uid, $upa);
    	  
        $view = new HtmlView;        
        if($id > 0){
        	 $view->setVar('ifLogin', "yes");
        	 $this->ServiceInterface->addLoginAccouting($id);
        	 $view->setVar('Profile', $this->ServiceInterface->getProfile($id));
           $view->render('ServiceInterface.tpl.php');
        }else{
           $view->setVar('ifLogin', "no");
           $view->render('ServiceInterface.tpl.php');
           if($uid != "") echo "Error! <input type=button value=\"Clear\" name=\"Clear\" onClick=\"ClearUid()\">";           
        }
    }
    protected function BankManager(){  
        $view = new HtmlView;
        $uid = $_GET[id];
        $view->setVar('DataForm', $this->ServiceInterface->getBankManager($uid));
        $view->render('MenuManager.tpl.php');    	      	
    }
    
    protected function addBankData(){
        $view = new HtmlView;
        $view->setVar('DataForm', $this->ServiceInterface->getBankAddForm());
        $view->render('MenuManager.tpl.php');          
    }

    protected function editBankData(){
        $id = $_GET['id'];       
        $view = new HtmlView;
        $view->setVar('DataForm', $this->ServiceInterface->getBankDataForm($id));
        $view->render('MenuManager.tpl.php');          	
    }

    protected function addBank(){
        $this->ServiceInterface->addBankData($_POST);
        $this->redirectTo('./index.php?act=BankManager');        
    }
    protected function delBank(){  
    	  $id = $_GET['id'];      
        $this->ServiceInterface->delBankData($id);
        $this->redirectTo('./index.php?act=BankManager');   	      	
    }

    protected function updateBank(){        
        $this->ServiceInterface->updateBankData($_POST);
        $this->redirectTo('./index.php?act=BankManager');   	      	
    }    

    protected function CheckCredit(){
    	  $id = $_GET['id'];      
    	  $this->ServiceInterface->CheckCredit($id);
    }

    protected function CheckCredit_1(){
        $token = $_GET['token'];       
        $view = new HtmlView;
        $view->setVar('DataForm', $this->CheckCredit->CheckCredit(1, $token));
        //$view->render('MenuManager.tpl.php');
    }

    protected function CheckCredit_2(){
        $token = $_GET['token'];       
        $view = new HtmlView;
        $view->setVar('DataForm', $this->CheckCredit->CheckCredit(2, $token));
        //$view->render('MenuManager.tpl.php');
    }    

    protected function CheckCredit_3(){
        $token = $_GET['token'];       
        $view = new HtmlView;
        $view->setVar('DataForm', $this->CheckCredit->CheckCredit(3, $token));
        //$view->render('MenuManager.tpl.php');
    }
    

    
    // 解構函式
    public function __destruct()
    {
      $this->infoTab = NULL;
      $this->myTab = NULL;
      $this->ws = NULL;
      $this->member = NULL;
      $this->manager = NULL;
    }

}
