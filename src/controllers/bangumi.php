<?php
class Bangumi_Controller extends Base_Controller
{
    private function show()
    {

    }
    public function run()
    {
        switch($_POST['do'])
        {
            case 'show':
                $this->show();
                break;
            case 'add':
                break;
            case 'modify':
                break;
        }
    }
}
?>