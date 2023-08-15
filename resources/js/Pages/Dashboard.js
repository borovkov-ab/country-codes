import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head } from '@inertiajs/inertia-react';
import Addcountry from '@/Components/Countries/Addcountry';
import CountryList from '@/Components/Countries/CountryList';

export default function Dashboard(props) {
    const [editForm, setEditForm] = React.useState({});

    props.fromBlockedCountry && alert('You are from blocked country');
    console.log('Your country is ' + (props.fromBlockedCountry?'blocked':'not blocked'));

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">You're logged in!</div>
                    </div>
                    <div className="flex">
                    <div className="max-w-7xl mx-auto basis-1/4 bg-white">
                        <div className="m-5 border">
                            <div className="bg-white overflow-hidden shadow-sm">
                                <Addcountry editForm={editForm}/>
                            </div>
                        </div>
                    </div>
                    <div className="max-w-7xl mx-auto basis-3/4 bg-white">
                        <div className="m-5 border">
                            <div className="bg-white overflow-hidden shadow-sm">
                                <CountryList countries={props.countries} setEditForm={setEditForm}/>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>



        </Authenticated>
    );
}
