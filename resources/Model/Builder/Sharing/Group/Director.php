<?php
/**
 * Director is part of the builder pattern. It knows the interface of the builder
 * and builds a complex object with the help of the builder. 
 */
class Model_Builder_Sharing_Group_Director
{
    /**
     * @param BuilderInterface $builder
     *
     * @return Parts\Group
     */
    public function build(Model_Builder_Sharing_Group_BuilderInterface $builder)
    {
        $builder->createGroup();
        $builder->addKeys();
        $builder->addGroupName();
        $builder->addRef();
        $builder->addValidita();
        $builder->addVisibile();
        $builder->addNoteConsegna();

        return $builder->getGroup();
    }
}