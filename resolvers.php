<?php

use RedBeanPHP\R;
use Siler\Graphql;

R::setup('sqlite:'.__DIR__.'/db.sqlite');

$queryType = [
    'contracts' => function ($root, $args, $context) {
        $contracts = R::findAll('contract');
        return array_map(function ($contract) use ($context) {
            $content = $contract['content'];
            $contract['maybeContent'] = $content;
            $contract['maybeContentWithExclamationMark'] = is_null($content) ? null : $content . '!';
            $contract['content'] = is_null($content) ? '' : $content;
            $contract['contentWithExclamationMark'] = $contract['content'] . '!';

            if ('tomas' !== $context) {
                unset($contract['secret']);
            }

            return $contract;
        }, $contracts);
    },
];

$mutationType = [
    'contract' => function ($root, $args, $context) {
        if ('tomas' === $context) {
            $contract = R::dispense('contract');
            $contract['content'] = $args['content'];
            $contract['secret'] = $args['secret'];

            R::store($contract);

            return $contract;
        }

        return null;
    },
];

return [
    'Query'    => $queryType,
    'Mutation' => $mutationType,
];
