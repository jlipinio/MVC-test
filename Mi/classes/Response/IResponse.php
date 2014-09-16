<?
namespace Mi\Response;

interface IResponse
{
    public function send($exit = true);
    public function push_header($header);
}