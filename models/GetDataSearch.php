<?php
/**
 * Created by PhpStorm.
 * User: Toole
 * Date: 30.03.2019
 * Time: 9:36
 */

namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class GetDataSearch extends GetData
{
    public function rules()
    {
        return[
            [['filename','filesize','filetype'], 'string', 'max' => 255],
            ['filetime','safe']
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params){
        $query = GetData::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 15
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'filesize', $this->filesize])
            ->andFilterWhere(['like', 'filetype', $this->filetype])
            ->andFilterWhere(['like', 'filetime', $this->filetime]);

        return $dataProvider;
    }
}