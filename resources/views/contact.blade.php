@extends('layouts.app')

@section('content')
    <section class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="max-w-3xl">
                <p class="text-sm font-semibold uppercase text-blue-700">Contact</p>
                <h1 class="mt-3 text-3xl font-bold text-gray-900 sm:text-4xl">Get in touch with our team</h1>
                <p class="mt-5 text-base leading-7 text-gray-600 sm:text-lg">
                    Need help with your account, a connected device, or irrigation services? Send us a message and our team
                    will help route your request to the right place.
                </p>
            </div>
        </div>
    </section>

    <section class="py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[0.85fr_1.15fr]">
                <div class="space-y-6">
                    <article class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Contact details</h2>
                        <div class="mt-5 space-y-4">
                            <div class="flex gap-4">
                                <div class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-blue-100 text-blue-700">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2 11H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <a href="mailto:support@example.com" class="mt-1 block text-gray-900 hover:text-blue-700">
                                        support@example.com
                                    </a>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-emerald-100 text-emerald-700">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.68l1.5 4.49a1 1 0 01-.5 1.21l-2.26 1.13a11.04 11.04 0 005.52 5.52l1.13-2.26a1 1 0 011.21-.5l4.49 1.5a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.16 21 3 14.84 3 7V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Phone</p>
                                    <a href="tel:+911234567890" class="mt-1 block text-gray-900 hover:text-emerald-700">
                                        +91 12345 67890
                                    </a>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-amber-100 text-amber-700">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Support hours</p>
                                    <p class="mt-1 text-gray-900">Monday to Saturday, 9:00 AM - 6:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="rounded-lg bg-gray-900 p-6 text-white shadow-sm">
                        <h2 class="text-lg font-semibold">Before you send</h2>
                        <ul class="mt-4 space-y-3 text-sm leading-6 text-gray-300">
                            <li>Include your account email so we can find the right profile quickly.</li>
                            <li>Mention the device name or service request number if your issue is related to one.</li>
                            <li>For urgent irrigation problems, call during support hours for faster handling.</li>
                        </ul>
                    </article>
                </div>

                <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
                    <div class="flex flex-col gap-2 border-b border-gray-200 pb-5">
                        <h2 class="text-xl font-semibold text-gray-900">Send a message</h2>
                        <p class="text-sm text-gray-500">Fill in the form below and our team will respond as soon as possible.</p>
                    </div>

                    <form class="mt-6 space-y-5" action="#" method="POST">
                        @csrf

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    placeholder="Your name"
                                    class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    placeholder="you@example.com"
                                    class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                            <input
                                id="subject"
                                name="subject"
                                type="text"
                                placeholder="How can we help?"
                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                placeholder="Write your message here..."
                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            ></textarea>
                        </div>

                        <div class="flex flex-col gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-sm text-gray-500">Typical response time: within 1 business day.</p>
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                            >
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
