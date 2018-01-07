<?php

class TreeNode
{

    /**
     * 节点存储的数据
     * @var null|string
     */
    public $data = NULL;
    /**
     * 节点的关联子节点
     * @var array
     */
    public $children = [];

    /**
     *
     * TreeNode constructor.
     * @param string|NULL $data
     */
    public function __construct(string $data = NULL)
    {
        $this->data = $data;
    }

    /**
     *
     * @param TreeNode $node
     */
    public function addChildren(TreeNode $node)
    {
        $this->children[] = $node;
    }

}

class Tree
{

    /**
     * 根节点
     * @var null|TreeNode
     */
    public $root = NULL;

    /**
     *
     * Tree constructor.
     * @param TreeNode $node
     */
    public function __construct(TreeNode $node)
    {
        $this->root = $node;
    }

    /**
     * 遍历方法
     * @param TreeNode $node
     * @param int $level
     */
    public function traverse(TreeNode $node, int $level = 0)
    {

        if ($node) {
            echo str_repeat("-", $level);
            echo $node->data . "\n";

            foreach ($node->children as $childNode) {
                //递归遍历
                $this->traverse($childNode, $level + 1);
            }
        }
    }

}

try {

    $ceo = new TreeNode("CEO");

    $tree = new Tree($ceo);

    $cto = new TreeNode("CTO");
    $cfo = new TreeNode("CFO");
    $cmo = new TreeNode("CMO");
    $coo = new TreeNode("COO");

    $ceo->addChildren($cto);
    $ceo->addChildren($cfo);
    $ceo->addChildren($cmo);
    $ceo->addChildren($coo);

    $seniorArchitect = new TreeNode("Senior Architect");
    $softwareEngineer = new TreeNode("Software Engineer");
    $userInterfaceDesigner = new TreeNode("User Interface Designer");
    $qualityAssuranceEngineer = new TreeNode("Quality Assurance Engineer");

    $cto->addChildren($seniorArchitect);
    $seniorArchitect->addChildren($softwareEngineer);
    $cto->addChildren($qualityAssuranceEngineer);
    $cto->addChildren($userInterfaceDesigner);

    $tree->traverse($tree->root);

} catch (Exception $e) {
    echo $e->getMessage();
}
