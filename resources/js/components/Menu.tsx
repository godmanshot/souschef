import React from "react";
import ReactDOM from 'react-dom';
import axios from 'axios';
import settings from '../settings';
import { WeekProperty, Week } from "../models/Week";
import WeekComponent from "./WeekComponent";
import Slider from "react-slick";
import { FaPlus } from 'react-icons/fa';
import { createStore } from "redux";
import _ from 'lodash';

export default class Menu extends React.Component<{}, {menu: Array<WeekProperty>}> {
    
    private slick_setting = {
        dots: true,
        infinite: false,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows:false
    };

    constructor(props:any) {
        super(props);
        this.state = {
            menu: []
        };

        this.addWeek = this.addWeek.bind(this);
        this.deleteWeek = this.deleteWeek.bind(this);
    }

    componentDidMount() {

        axios.request({
            url: settings.APP_URL+'/menu'
        }).then((response: {data: {data: Array<WeekProperty>}}) => {
            this.setState({menu: response.data.data});
        });

    }

    addWeek() {
        axios.post(settings.APP_URL+'/weeks')
        .then((response: any) => {
            let new_menu:any = this.state.menu;
            new_menu.push(response.data);
            this.setState({menu: new_menu});
        });
    }

    deleteWeek(week:Week) {
        let delete_q = confirm("Вы уверены, что хотите удалить неделю?");

        if(delete_q) {
            axios.delete(settings.APP_URL+'/weeks/'+week.id)
            .then((response: any) => {
                let new_menu:any = this.state.menu;
                _.remove(new_menu, (n:any) => {
                    return n.id == week.id;
                });
                this.setState({menu: new_menu});
            });
        } else {

        }
    }

    render() {

        let weeks = this.state.menu.map((value: Week) => <WeekComponent key={value.id} data={new Week(value)} deleteWeek={this.deleteWeek}/>);

        return <div className="menu_builder">
            <h1>Недели</h1>
            <div className="weeks">
                <Slider {...this.slick_setting}>
                    {weeks}
                    <div className="add_week">
                        <h3 className="title" onClick={this.addWeek}><FaPlus /> Добавить неделю</h3>
                    </div>
                </Slider>
            </div>
        </div>;
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Menu />, document.getElementById('example'));
}
