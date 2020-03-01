import React from "react";
import { Week } from "../models/Week";
import Category from "../models/Category";
import settings from '../settings';

export default class DishComponent extends React.Component<{data: any, week: Week, category: Category, deleteDish: Function}> {
    render() {
        let week = this.props.week;
        let category = this.props.category;
        let dish = this.props.data;

        return <div>
            
            <a href={settings.APP_URL.replace('/api', '')+'/admin/dishes/'+this.props.data.id+'/edit'} target="_blank">{this.props.data.name}</a>
            <span onClick={() => this.props.deleteDish(week, category, dish)} style={{fontSize: '1rem', cursor: 'pointer', margin: '10px', color: '#d46d6d'}}>Удалить</span>
        </div>;
    }
}